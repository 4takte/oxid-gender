[{$smarty.block.parent}]
[{assign var="vierDbGenderOtherValue" value=$oViewConf->vierGetOtherGenderDbValue()}]
<option value="[{$vierDbGenderOtherValue}]"  [{if $value  == $vierDbGenderOtherValue  or $value2 == $vierDbGenderOtherValue}]SELECTED[{/if}]>[{oxmultilang ident="VIER_GENDER_OTHER"}]</option>
