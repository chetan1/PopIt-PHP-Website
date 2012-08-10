#Indian MPs
An Indian Parliamentary directory built on top of [PopIt](https://github.com/mysociety/popit).

## Status

The website currently features profiles of all the Members of the Indian Parliament. We  plan to add more sources as we progress. 

## Requirements

The site uses the Yii PHP framework for the backend and the Twitter bootsrap library for the frontend. It uses [PopIt](https://github.com/mysociety/popit) for the data layer.

## Using PopIt to Setup a Website

1. Create an instance on the [PopIt site](http://popit.mysociety.org/instances/new).

2. Get the PHP bindings for PopIt from [Github repo](https://github.com/mysociety/popit-php).

3. Use the credentials used in (1) to initialize the PopIt object like [here](https://github.com/chetan1/PopIt-PHP-Website/blob/master/protected/components/PopIt/prs.php#L7).

4. Use the PopIt object to read/insert/update/delete data on the PopIt site.

5. Import data into PopIt using the API. For this website the code for importing data can be found [here](https://github.com/chetan1/PopIt-PHP-Website/blob/master/protected/components/PopIt/prs.php).

6. Code for searching data on PopIt can be found [here](https://github.com/chetan1/PopIt-PHP-Website/blob/master/protected/components/PopIt/prs.php#L59).

## Demo

Try the live demo on [http://www.jobsify.in/popit/](http://www.jobsify.in/popit/).
