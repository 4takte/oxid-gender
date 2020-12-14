<?php
/**
 * MIT License
 * Copyright (c) 2020 Markus Schröder <ms@4takte.de>
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @copyright (c) Markus Schröder | 2020
 * @link https://github.com/4takte/oxid-gender
 * @package Viertakte/OxidGender
 * @version 1.0.0
 */

$_sVierModuleId = "oxid-gender";
$_sVierNameSpace = "\Viertakte\OxidGender";
$sMetadataVersion = '2.0';

$aModule = array(
    'id' => 'viertakte-'.$_sVierModuleId,
    'title' => '4takte/'.$_sVierModuleId,
    'description' => array(
        'de' => 'Wird eine Auswahl der Anrede, bzw. des Geschlechts, im Onlineshop für den Nutzer auswählbar gemacht, 
        oder gar als Pfilchtfeld angegeben, so muss dem Nutzer eine weitere Option zur Verfügung gestellt werden,
         um das dritte Geschlecht nicht zu diskreminieren.<br>Dieses Modul fügt der Anrede-Vorlage eine weitere Option für das Geschlecht hinzu. 
         Der Datenbankwert für die neue Option kann als Konfigurationsparameter im Modul definiert werden.<br>
         Die Metadatenversion ist auf 2.0 eingestellt, sodass die Theme-Option im Blockabschnitt verwendet werden konnte. 
         Es gibt einen benutzerdefinierten Vorlagenblock mit einem Radio-Input anstelle eines Select Felds.',
        'en' => 'If a selection of the salutation or gender is made selectable for the user in the online shop, 
        or is even given as an arrow field, the user must be provided with another option 
        in order not to discriminate against the third gender.<br>This module adds another gender option to the salutation template. 
        You can define the db value as a config param. <br> Metadata version is set to 2.0 to make use of the theme option in the block section. 
        There is a custom template block with a radio input instead of a select.',
    ),
    'thumbnail' => 'oxid-module.jpg',
    'version' => '1.0.0',
    'author' => 'Markus Schröder',
    'url' => 'https://github.com/4takte/oxid-gender',
    'email' => 'ms@4takte.de',
    'extend' => [
        \OxidEsales\Eshop\Core\ViewConfig::class => \Viertakte\OxidGender\Core\ViewConfig::class
    ],
    'controllers' => [
        'viergendercron' => \Viertakte\OxidGender\Application\Controller\CronController::class
    ],
    'events' => [
        'onActivate' => $_sVierNameSpace.'\Core\ModuleEvents::onActivate',
        'onDeactivate' => $_sVierNameSpace.'\Core\ModuleEvents::onDeactivate'
    ],
    'blocks' => [
        // frontend flow & wave (input type=select)
        [
            'template' => 'form/fieldset/salutation.tpl',
            'block'    => 'salutation_options',
            'file'     => 'Application/views/blocks/select/salutation_options.tpl',
        ],
        // frontend viertakte/custom (input type=radio)
        [
            'theme' => 'viertakte',
            'template' => 'form/fieldset/salutation.tpl',
            'block'    => 'salutation_options',
            'file'     => 'Application/views/blocks/radio/salutation_options.tpl',
        ],
        // backend
        [
            'template' => 'user_address.tpl',
            'block'    => 'admin_user_address_form',
            'file'     => 'Application/views/blocks/admin/admin_user_address_form.tpl',
        ],
        [
            'template' => 'user_main.tpl',
            'block'    => 'admin_user_main_form',
            'file'     => 'Application/views/blocks/admin/admin_user_main_form.tpl',
        ],
        [
            'template' => 'user_main.tpl',
            'block'    => 'admin_user_main_form',
            'file'     => 'Application/views/blocks/admin/admin_user_main_form.tpl',
        ],
        [
            'template' => 'order_address.tpl',
            'block'    => 'admin_order_address_billing',
            'file'     => 'Application/views/blocks/admin/admin_order_address_billing.tpl',
        ],
        [
            'template' => 'order_address.tpl',
            'block'    => 'admin_order_address_delivery',
            'file'     => 'Application/views/blocks/admin/admin_order_address_delivery.tpl',
        ],
    ],
    'settings' => [
        [
            'group' => 'vierModuleSettingsMain',
            'name' => 'sVierOtherGenderDbIdentifier',
            'type' => 'str',
            'value' => 'OTHER'
        ],
        [
            'group' => 'vierModuleSettingsMain',
            'name' => 'sVierGenderCronAuth',
            'type' => 'str',
            'value' => 'vS8jcd5QwrZ4aKsA'
        ]
    ]
);
