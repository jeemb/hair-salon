# _Hair Salon_

#### MySQL PHP Database Program 2.24.2017

#### By Jennifer Beem

## Description

This database program collects and summarizes stylist and client information for a hair salon. Program also has editing and deleting capabilities.

### Application Specifications

|Behavior|Input|Output|
|--------|-----|------|
|App collects information on new stylist and displays to page. | "Bob"| Information displayed on page.
|App allows user to edit any stylist information.|User clicks edit button|User is directed to edit page|
|App redirects any edits made to stylist information back to stylist page to display changes.|User changes stylist name "Bob" to "Robert"|Routes back to stylist page and displays updated name|
|App displays all clients on new page for particular stylist when stylist name is clicked on.|User clicks "Janice"|App routes user to client page for stylist which shows all entered clients for that stylist|
|App collects information on new client added to particular stylist|User inputs new client "Mary"|App displays new client on page|
|App allows user to edit client information.|User clicks edit button|App routes user to edit page|
|App redirects any edits made to client information back to stylist page to display changes.|User changes client name "Mary" to "May"|Routes back to stylist page and displays updated name|

## Setup/Installation Requirements

* Clone this repository
* Open up computer terminal
* Run `$ composer install`
* Navigate into this project's "web" folder. Run `$ cd web`
* Run `php -S localhost:8000` to setup document root
* Open up web browser and navigate to **`localhost:8000`** to view program

## Known Bugs

None known.

## Support and contact details

Feel free to contact me at: jenniferbeem@gmail.com if any questions come up!

## Technologies Used

* PHP/Silex
* HTML/Twig
* PHPUnit for testing
* MySQL Database
* CSS/Bootstrap

### License

Copyright (c) 2017 Jennifer Beem
This software is licensed under the MIT license.
