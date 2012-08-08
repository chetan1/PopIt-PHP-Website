<?php

class Prs{

    public static function sync()
    {
        $popit = new PopIt(Yii::app()->params['PopIt']);

        $people = People::model()->findAll();
        $storedData = self::getStoredData($popit);
//        $popit->emptyInstance();
//        die();
        
        foreach($people as $p)
        {
            if(isset($storedData['organisation'][$p->house]))
                $orgId = $storedData['organisation'][$p->house];
            else
            {
                $call = $popit->add('organisation', array('name' => $p->house));
                $orgId = $call['_id'];
                $storedData['organisation'][$p->house] = $orgId;
            }

            $links =  $p->getLinks();

            $person = $popit->add('person', array(
                'name' => $p->name,
                'summary' => json_encode($p->getExtraData()),
                'links' => $links,
                
            ));

            $position = $popit->add('position', array(
                'title' => 'Member of ' . $p->house,
                'person' => $person['_id'],
                'organisation' => $orgId,
            ));
        }

    }

    protected static function getStoredData($popit)
    {
        $storedData = $popit->getAll();
        $data = array();

        foreach($storedData as $key=>$values)
            if(count($values) > 0)
                foreach($values as $v)
                    if(count($v) > 0)
                        if($key == 'position')
                            $data[$key][$v['title']] = $v['_id'];
                        else
                            $data[$key][$v['name']] = $v['_id'];

        return $data;
    }

    public static function search($q)
    {
        
    }
    
}
