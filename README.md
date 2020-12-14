# oxid-gender
If a selection of the salutation or gender is made selectable for the user in the online shop, or is even given as an arrow field, the user must be provided with another option in order not to discriminate against the third gender.

## Features
- adds another gender option to the salutation template in theme
- extended salutaion fields in admin
- you can define the db value for the new option as a module config param
- optional cronjob controller to fix/set corrupt user salutation entries

## Installation
### 1 - Install with composer
```
composer require 4takte/oxid-gender:"dev-main"
```
### 2 - Add the missing block to your theme
There are open pull requests asking to integrate this block in flow and wave theme.  
For now you have to integrate them yourself.

theme > form > fieldset > salutation.tpl
add the block "salutation_options"
```
<select name="[{$name}]"
        [{if $class}]class="[{$class}]"[{/if}]
        [{if $id}]id="[{$id}]"[{/if}]
        [{if $required}]required="required"[{/if}]>
        [{block name="salutation_options"}]
                <option value="" [{if empty($value)}]SELECTED[{/if}]>[{oxmultilang ident="DD_CONTACT_SELECT_SALUTATION"}]</option>
                <option value="MRS" [{if $value|lower  == "mrs" or $value2|lower == "mrs"}]SELECTED[{/if}]>[{oxmultilang ident="MRS"}]</option>
                <option value="MR"  [{if $value|lower  == "mr"  or $value2|lower == "mr"}]SELECTED[{/if}]>[{oxmultilang ident="MR" }]</option>
        [{/block}]
</select>
```
### 3 - Activate module in Oxid eshop admin
### 4 - Clear smarty template cache

## Cronjob (optional)
Express payment methods like PayPal, AmazonPay as well as other external systems might insert address and user data during checkout or order import.
As we noticed a small amount of users have not been correctly formated to OXID eShop standard salutation. 

The cronjob executes sql queries in oxuser and oxaddress to fix these.

- empty values update to new gender db value (config-option)
- non-standard and clearly assignable values get updated to oxid standard values
- you can easily change the cron to your needs

### Check this db query first

This query outputs grouped salutation values. Executes in local docker environment in 0.539 s (~ 500.000 user)  
Analyze query output and change the properties of \Viertakte\OxidGender\Application\Controller\CronController to your needs.
There might also be buggy entries in oxaddress. In our tests we didn´t find any, so there are currently no quries for oxaddress implemented.
```
select distinct oxsal, count(oxsal) from oxuser group by oxsal having oxsal NOT IN ('MR','MRS', '');
```
### Cronjob Url
```
https://your-shop-url.com/index.php?cl=viergendercron&cronkey=vS8jcd5QwrZ4aKsA
```
## Additional information / judgment of the regional court
LG Frankfurt am Main - Az. 2-13 O 131/20 - 03.12.2020  
[lto.de](https://www.lto.de/recht/nachrichten/n/lg-frankfurt-am-main-2-13-o-131-20-geschlechtsneutrale-anrede-beim-fahrkartenkauf-diskriminierung-allgemeines-persoenlichkeitsrecht/) |
[onlinehaendler-news.de](https://www.onlinehaendler-news.de/e-recht/aktuelle-urteile/134043-drittes-geschlecht-online-shops-waehlbar)


## License
    Copyright (c) 2020 Markus Schröder <ms@4takte.de>
    
    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.


## Copyright
(c) 2020 4takte
