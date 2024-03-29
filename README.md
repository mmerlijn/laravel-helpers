# Laravel Helpers

### Summary

Casts

- Phone Rules

Rules

- Bsn
- Requestnr

Facades

- Distance

Traits

- AddressModelTrait
- NameModelTrait

# install

```
composer require mmerlijn/laravel-helpers
```

## For flash message

add to app.js

```js
import flashHandler from '../../vendor/mmerlijn/laravel-helpers/resources/js/flashHandler';

Alpine.data('flashHandler', flashHandler)
window.flash = msg => window.dispatchEvent(new CustomEvent('flash', {detail: msg}))
```

add to the preferred layout.blade (bottom of body)

```html

<x-mm-flash/>
```

### Flash usage

```php
Flash::message('Hello World')->type('noticee')->add();
```

or

```html

<button x-data="{}" @click="$dispatch('flash',{text:'Hi'})">Click me</button>
```

or

```js
flash('Hi, all!')
```

## Casts

### Phone

Setter will cast phone to only numbers string

Getter will cast phone to a readable format

`` Important!!`` fill city field before phone fields for the use of kental

##### Example

```php
//In YourModel.php

    protected $casts = [
        'phone' => Phone::class,
    ];

//setter => 0612345678
//getter => PhoneModel class

//methods
$model->phone->get(); // returns 06 1234 5678
$model->phone->set(); // returns 0612345678
$model->phone->smsPhone(); //returns +31612345678 or exception
$model->phone->withCountryCode('it'); //returns +39612345678
```

### Initials

Setter will strip all none alphabetic characters

Getter will split all letters with a dot

##### Example

```php
//In YourModel.php

    protected $casts = [
        'initials' => Initials::class,
    ];

//setter => BAR
//getter => B.A.R.
```

## Rules (validators)

### BSN

Validates Dutch BSN

##### Example

```php
Validator::make([],[
  'bsn'=> [new Bsn]
]);
```

### Requestnr

validate requestnr

regex: '/^((ZD|ZP|CW){1}\d{8}|(PG){1}\d{9})$/i'

```php
Validator::make([],[
  'request_nr'=> [new Requestnr]
]);
```

## Facades

### Distance

Calculate distance between to coordinates

##### usage

```php
//with coordinates
Distance::from(52.4968, 5.0727)
    ->to(52.5144, 4.9641)
    ->get();
    
//with cities
Distance::from("Volendam")
    ->to("Purmerend")
    ->get();
```

The get method accepts three params: unit, format,precision

### Flash

Adds a flash message to the session flash

##### usage

```php
//with coordinates
Flash::message('Hello World')
    ->type('success')
    ->duration(3000)
    ->add();
```

The get method accepts three params: unit, format,precision

```php
->get(unit:"m"); //distance in meter (default km)
->get(format:true) // 5,4 km
```

## Traits

### AddressModelTrait

#### Required database fields

city, street, building, postcode

##### installation

Add to your model

```php
use AddressModelTrait;
```

This will trigger an attribute setter and getter.

##### Usage

```php
$model->address->street;
```

### NameModelTrait

#### Required database fields

initials, lastname, prefix, own_lastname, own_prefix, sex

##### installation

Add to your model

```php
use NameModelTrait;
```

This will trigger an attribute setter and getter.

##### Usage

```php
$model->name->salutation; // Dhr. / Mevr.
$model->name->name; //Full name 
```
