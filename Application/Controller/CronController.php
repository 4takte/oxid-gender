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
 * cronjob controller
 * Executes several sql queries to update "wrong" user salutation to oxid standard values.
 *
 * @copyright (c) Markus Schröder | 2020
 * @link https://github.com/4takte/oxid-gender
 * @package Viertakte/OxidGender
 * @version 1.0.0
 */

namespace Viertakte\OxidGender\Application\Controller;


use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use phpDocumentor\Reflection\Types\Void_;

class CronController extends FrontendController
{

    /**
     * female search values
     *
     * @var string[] $_aFemaleValues
     */
    protected $_aFemaleValues = ['miss', 'Frau'];

    /**
     * male search values
     *
     * @var string[] $_aMaleValues
     */
    protected $_aMaleValues = ['Mister', 'Mr.', 'Herr'];

    /**
     * simple auth by req param
     *
     * @var string $_sVerySimpleAuth
     */
    protected $_sVerySimpleAuth;

    /**
     * keep empty entries or convert them to "other"
     *
     * @var bool
     */
    protected $_blKeepEmptyEntries = true;

    /**
     * set auth by request param
     *
     * @return void
     */
    public function init()
    {
        $this->_sVerySimpleAuth = $this->getConfig()->getConfigParam('sViewGenderCronAuth');
        return parent::init();
    }

    /**
     * execute cron or die
     *
     * @return void
     */
    public function render()
    {
        $ret = parent::render();

        if (Registry::get(Request::class)->getRequestEscapedParameter('vsa') == $this->_sVerySimpleAuth) {
            $this->_fixUserEntries();
        }

        exit(0);
    }

    /**
     * Executes several sql queries to update "wrong" user salutation to oxid standard values.
     * Update this function to your needs.
     *
     * @return void
     */
    protected function _fixUserEntries():void
    {
        /** @var \OxidEsales\Eshop\Core\DatabaseProvider $oDb */
        $oDb = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();

        // update all entries with oxsal='' to new gender identifier
        if ($this->_blKeepEmptyEntries === true) {
            $sVierOtherGenderDbIdentifier = Registry::getConfig()->getConfigParam("sVierOtherGenderDbIdentifier");
            if ($sVierOtherGenderDbIdentifier) {
                $sQOther = "update oxuser set oxsal={$oDb->quote($sVierOtherGenderDbIdentifier)} where oxsal=''";
                $rsUpdateOther = $oDb->execute($sQOther);
            }
        }

        // update all fenale entries to oxid std value
        $sQFemale = "update oxuser set oxsal='MRS' where oxsal in (".implode(",", $this->_aFemaleValues).")";
        $rsUpdateFemale = $oDb->execute($sQFemale);

        // update all male entries to oxid std value
        $sQMale = "update oxuser set oxsal='MR' where oxsal in (".implode(",", $this->_aMaleValues).")";
        $rsUpdateMale = $oDb->execute($sQMale);

    }

}
