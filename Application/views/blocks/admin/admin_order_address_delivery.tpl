<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_BILLSAL"}]
    </td>
    <td class="edittext">
        <select name="editval[oxorder__oxdelsal]" class="editinput" [{$readonly}]>
            <option value="MR"  [{if $edit->oxorder__oxdelsal->value|lower  == "mr"}]SELECTED[{/if}]>[{oxmultilang ident="MR"}]</option>
            <option value="MRS" [{if $edit->oxorder__oxdelsal->value|lower  == "mrs"}]SELECTED[{/if}]>[{oxmultilang ident="MRS"}]</option>
            [{* oxid-gender - start *}]
            [{assign var="sVierOtherGenderDbVal" value=$oViewConf->vierGetOtherGenderDbValue()}]
            <option value="[{$sVierOtherGenderDbVal}]" [{if $edit->oxuser__oxsal->value  == $sVierOtherGenderDbVal}]SELECTED[{/if}]>[{oxmultilang ident="VIER_GENDER_OTHER"}]</option>
            [{* oxid-gender - end *}]
        </select>
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_NAME"}]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="10" maxlength="[{$edit->oxorder__oxdelfname->fldmax_length}]" name="editval[oxorder__oxdelfname]" value="[{$edit->oxorder__oxdelfname->value}]" [{$readonly}]>
        <input type="text" class="editinput" size="20" maxlength="[{$edit->oxorder__oxdellname->fldmax_length}]" name="editval[oxorder__oxdellname]" value="[{$edit->oxorder__oxdellname->value}]" [{$readonly}]>
        [{oxinputhelp ident="HELP_GENERAL_NAME"}]
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_COMPANY"}]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="37" maxlength="[{$edit->oxorder__oxdelcompany->fldmax_length}]" name="editval[oxorder__oxdelcompany]" value="[{$edit->oxorder__oxdelcompany->value}]" [{$readonly}]>
        [{oxinputhelp ident="HELP_GENERAL_COMPANY"}]
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_STREETNUM"}]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="28" maxlength="[{$edit->oxorder__oxdelstreet->fldmax_length}]" name="editval[oxorder__oxdelstreet]" value="[{$edit->oxorder__oxdelstreet->value}]" [{$readonly}]> <input type="text" class="editinput" size="5" maxlength="[{$edit->oxorder__oxdelstreetnr->fldmax_length}]" name="editval[oxorder__oxdelstreetnr]" value="[{$edit->oxorder__oxdelstreetnr->value}]" [{$readonly}]>
        [{oxinputhelp ident="HELP_GENERAL_STREETNUM"}]
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_ZIPCITY"}]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="5" maxlength="[{$edit->oxorder__oxdelzip->fldmax_length}]" name="editval[oxorder__oxdelzip]" value="[{$edit->oxorder__oxdelzip->value}]" [{$readonly}]>
        <input type="text" class="editinput" size="25" maxlength="[{$edit->oxorder__oxdelcity->fldmax_length}]" name="editval[oxorder__oxdelcity]" value="[{$edit->oxorder__oxdelcity->value}]" [{$readonly}]>
        [{oxinputhelp ident="HELP_GENERAL_ZIPCITY"}]
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_EXTRAINFO"}]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="37" maxlength="[{$edit->oxorder__oxdeladdinfo->fldmax_length}]" name="editval[oxorder__oxdeladdinfo]" value="[{$edit->oxorder__oxdeladdinfo->value}]" [{$readonly}]>
        [{oxinputhelp ident="HELP_GENERAL_EXTRAINFO"}]
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_STATE"}]
    </td>
    <td class="edittext">
        <select id="del_state_select" class="editinput" name="editval[oxorder__oxdelstateid]" [{$readonly}]>
            [{if $edit->oxorder__oxdelstateid->value}]
                [{foreach from=$countrylist item=country key=country_id}]
                    [{if $country_id == $edit->oxorder__oxdelcountryid->value}]
                        [{assign var=countryStates value=$country->getStates()}]
                        [{foreach from=$countryStates item=state key=state_id}]
                            <option value='[{$state->oxstates__oxid->value}]' [{if $edit->oxorder__oxdelstateid->value == $state->oxstates__oxid->value}]selected[{/if}]>[{$state->oxstates__oxtitle->value}]</option>
                        [{/foreach}]
                    [{/if}]
                [{/foreach}]
            [{else}]
                <option value=''>---</option>
            [{/if}]
        </select>
        [{oxinputhelp ident="HELP_GENERAL_STATE"}]
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_COUNTRY"}]
    </td>
    <td class="edittext">
        <select onchange="getCountryStates('del_country_select', 'del_state_select');" id="del_country_select" class="editinput" name="editval[oxorder__oxdelcountryid]" [{$readonly}]>
            <option value=''>---</option>
            [{foreach from=$countrylist item=oCountry}]
                <option value="[{$oCountry->oxcountry__oxid->value}]" [{if $oCountry->oxcountry__oxid->value == $edit->oxorder__oxdelcountryid->value}]selected[{/if}]>[{$oCountry->oxcountry__oxtitle->value}]</option>
            [{/foreach}]
        </select>
        [{oxinputhelp ident="HELP_GENERAL_COUNTRY"}]
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_FON"}]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="12" maxlength="[{$edit->oxorder__oxdelfon->fldmax_length}]" name="editval[oxorder__oxdelfon]" value="[{$edit->oxorder__oxdelfon->value}]" [{$readonly}]>
        [{oxinputhelp ident="HELP_GENERAL_FON"}]
    </td>
</tr>
<tr>
    <td class="edittext">
        [{oxmultilang ident="GENERAL_FAX"}]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="12" maxlength="[{$edit->oxorder__oxdelfax->fldmax_length}]" name="editval[oxorder__oxdelfax]" value="[{$edit->oxorder__oxdelfax->value}]" [{$readonly}]>
        [{oxinputhelp ident="HELP_GENERAL_FAX"}]
    </td>
</tr>
