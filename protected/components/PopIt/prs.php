<?php

class Prs{

    public static function init()
    {
        return new PopIt(Yii::app()->params['PopIt']);
    }

    public static function sync()
    {
        $popit = self::init();
        $people = People::model()->findAll();
        $storedData = self::getStoredData($popit);
        
        foreach($people as $p)
        {
            if(!isset($storedData['person'][$p->name]))
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

                $person = $popit->add('person', $p->getSyncData());
                $position = $popit->add('position', array(
                    'title' => 'Member of ' . $p->house,
                    'person' => $person['_id'],
                    'organisation' => $orgId,
                ));
            }
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
        $popit = self::init();
        $result = $popit->search($q);
        return $result['results'];
    }

    public static function getPersonLink($slug)
    {
        return "http://" . Yii::app()->params['PopIt']['instanceName'] . "." . Yii::app()->params['PopIt']['hostName'] . "/person/" . $slug;
    }

}
