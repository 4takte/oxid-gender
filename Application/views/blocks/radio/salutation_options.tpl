[{$smarty.block.parent}]
[{assign var="vierDbGenderOtherValue" value=$oViewConf->vierGetOtherGenderDbValue()}]
<div class="d-inline-block">
    <label for="[{$id}]_other" class="btn-radio">
        <input type="radio" id="[{$id}]_other" name="[{$name}]"  value="[{$vierDbGenderOtherValue}]" [{if $value  == $vierDbGenderOtherValue or $value2 == $vierDbGenderOtherValue}]checked="checked"[{/if}]>
        [{oxmultilang ident="VIER_GENDER_OTHER"}]
    </label>
</div>
