/**
 * Created with JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 1:49 PM
 * To change this template use File | Settings | File Templates.
 */
var i = 0;
var cost = 0;
var selected = "";

function setPotion(id,hidden,price,item_id, div)
{
    var x=document.getElementById(id);
    var y=document.getElementById(hidden);
    var z = document.getElementById(price);
    var wallet = document.getElementById('wallet');
    var inv_id = document.getElementById(item_id);
    document.getElementById('ptn_qty').innerHTML = 0;
    var cnt = parseInt(document.getElementById('ptn_qty').innerHTML);

    if (parseInt(wallet.innerHTML) < parseInt(z.innerHTML) || cnt == 0) {
        document.getElementById('btn_submit').disabled=true;
    }
    else {
        document.getElementById('btn_submit').disabled=false;
    }

    if(selected != "") {
        document.getElementById(selected).className = 'td-item';
    }

    switch(x.value) {
        case 'Herb':
            if (y.className=='hidden') {
                y.className = 'unhidden';
            }
            if (document.getElementById(div).className == 'td-item') {
                document.getElementById(div).className = 'td-glow';
            }
            var qty = getQuantity(x.value);
            document.getElementById('ptn_qty_min').value = qty;
            document.getElementById('max_ptn_qty').innerHTML = parseInt(10 - qty);
            document.getElementById('ptn_qty_max').value = parseInt(10 - qty);
            document.getElementById('in_inventory').innerHTML = qty;
            // document.getElementById('ptn_qty_count').value = qty;
            // document.getElementById('ptn_qty').innerHTML = 0;
            document.getElementById('price').value = z.innerHTML;
            document.getElementById('max_price').value = wallet.innerHTML;
            document.getElementById('total_price').value = 0;
            document.getElementById('inv_id').value = inv_id.value;
            document.getElementById('item_name').value = x.value;
            i = 0;
            cost = 0;
            selected = div;
            break;
        case 'Potion':
            if (y.className=='hidden') {
                y.className = 'unhidden';
            }
            if (document.getElementById(div).className == 'td-item') {
                document.getElementById(div).className = 'td-glow';
            }
            var qty = getQuantity(x.value);
            document.getElementById('ptn_qty_min').value = qty;
            document.getElementById('max_ptn_qty').innerHTML = parseInt(10 - qty);
            document.getElementById('ptn_qty_max').value = parseInt(10 - qty);
            document.getElementById('in_inventory').innerHTML = qty;
            // document.getElementById('ptn_qty_count').value = qty;
            // document.getElementById('ptn_qty').innerHTML = 0;
            document.getElementById('price').value = z.innerHTML;
            document.getElementById('max_price').value = wallet.innerHTML;
            document.getElementById('total_price').value = 0;
            document.getElementById('inv_id').value = inv_id.value;
            document.getElementById('item_name').value = x.value;
            i = 0;
            cost = 0;
            selected = div;
            break;
        case 'Mega Potion':
            if (y.className=='hidden') {
                y.className = 'unhidden';
            }
            if (document.getElementById(div).className == 'td-item') {
                document.getElementById(div).className = 'td-glow';
            }
            var qty = getQuantity(x.value);
            document.getElementById('ptn_qty_min').value = qty;
            document.getElementById('max_ptn_qty').innerHTML = parseInt(10 - qty);
            document.getElementById('ptn_qty_max').value = parseInt(10 - qty);
            document.getElementById('in_inventory').innerHTML = qty;
            // document.getElementById('ptn_qty_count').value = qty;
            // document.getElementById('ptn_qty').innerHTML = 0;
            document.getElementById('price').value = z.innerHTML;
            document.getElementById('max_price').value = wallet.innerHTML;
            document.getElementById('total_price').value = 0;
            document.getElementById('inv_id').value = inv_id.value;
            document.getElementById('item_name').value = x.value;
            i = 0;
            cost = 0;
            selected = div;
            break;
    }
}

function getQuantity(id)
{
    var x=document.getElementById(id);

    return (x == null) ? 0 : x.value;
}



function incrementItem(id)
{

    if(parseInt(document.getElementById('ptn_qty').innerHTML) == 0) {
        document.getElementById('btn_submit').disabled=true;
    }
    else {
        document.getElementById('btn_submit').disabled=false;
    }

    var count = parseInt(document.getElementById('ptn_qty_min').value);
    var max = 10 - count;
    var money = parseInt(document.getElementById('max_price').value);
    var price = parseInt(document.getElementById('price').value);
    var max_sale = Math.floor(money / price);

    if(max_sale>=max) {
        var total_price = max * price;
    }
    if(max_sale<max) {
        max = max_sale;
        var total_price = max * price;
    }
    if(i>=max) {
        var l = max;
    } else {
        var l = i+=1;
        var total_price = cost += price;
    }

    document.getElementById(id).value = l;
    document.getElementById('ptn_qty').innerHTML = l;
    document.getElementById('total_price').value = total_price;

    if(parseInt(document.getElementById('ptn_qty').innerHTML) == 0) {
        document.getElementById('btn_submit').disabled=true;
    }
    else {
        document.getElementById('btn_submit').disabled=false;
    }
}

function decrementItem(id)
{
    if(parseInt(document.getElementById('ptn_qty').innerHTML) == 0) {
        document.getElementById('btn_submit').disabled=true;
    }
    else {
        document.getElementById('btn_submit').disabled=false;
    }

    var price = parseInt(document.getElementById('price').value);
    if(i<=0) {
        var l = 0;
        var total_price = 0;
    } else {
        var l = i-=1;
        var total_price = cost -= price;
    }

    document.getElementById(id).value = l;
    document.getElementById('ptn_qty').innerHTML = l;
    document.getElementById('total_price').value = total_price;

    if(parseInt(document.getElementById('ptn_qty').innerHTML) == 0) {
        document.getElementById('btn_submit').disabled=true;
    }
    else {
        document.getElementById('btn_submit').disabled=false;
    }
}

function setEquip(name, stat, type, id, level)
{
    var equip_name = document.getElementById(name);
    var equip_stat = document.getElementById(stat);
    var equip_type = document.getElementById(type);
    var equip_id = document.getElementById(id);
    var myImgSrcArmor = "/bootstrap/img/Armors/armor";
    var myImgSrcWeapon = "/bootstrap/img/Weapons/weapon";
    var gender = document.getElementById('gender').value;
    var equip_level = document.getElementById(level);

    switch(equip_type.value) {
        case 'weapon' :
            if (equip_id.value != document.getElementById('w_equiped_id').value) {
                document.getElementById('damage').value = equip_stat.innerHTML;
                document.getElementById('is_weapon').value = equip_type.value;
                document.getElementById('weapon_id').value = equip_id.value;
                document.getElementById('weapon_name').value = equip_name.innerHTML.trim();
                document.getElementById('img_weapon').src = myImgSrcWeapon.concat(equip_id.value,'-200x200.jpg');
                document.getElementById('btn_submit').disabled=false;
            }
            break;
        case 'armor' :
            if (equip_id.value != document.getElementById('a_equiped_id').value) {
                document.getElementById('armor').value = equip_stat.innerHTML;
                document.getElementById('is_armor').value = equip_type.value;
                document.getElementById('armor_id').value = equip_id.value;
                document.getElementById('armor_name').value = equip_name.innerHTML.trim();
                document.getElementById('img_armor').src = myImgSrcArmor.concat(equip_id.value,gender,'.jpg');
                document.getElementById('equip_level').value = equip_level.innerHTML;
                document.getElementById('btn_submit').disabled=false;
            }
            break;
    }
}

function setCurrent()
{
    var myImgSrcArmor = "/bootstrap/img/Armors/armor";
    var myImgSrcWeapon = "/bootstrap/img/Weapons/weapon";
    var equipped_w = document.getElementById('w_equiped_id').value;
    var equipped_a = document.getElementById('a_equiped_id').value;
    var gender = document.getElementById('gender').value;

    document.getElementById('img_weapon').src = myImgSrcWeapon.concat(equipped_w,'-200x200.jpg');
    document.getElementById('img_armor').src = myImgSrcArmor.concat(equipped_a,gender,'.jpg');
    document.getElementById('btn_submit').disabled=true;
}

function usePotion(id, name, value, quantity, type, div)
{
    var inv_id = document.getElementById(id);
    var potion_name = document.getElementById(name);
    var useage_value = document.getElementById(value);
    var item_quantity = document.getElementById(quantity);
    var potion_type = document.getElementById(type);

    if(selected != "") {
        document.getElementById(selected).className = 'b-item';
    }

    if (document.getElementById(div).className == 'b-item') {
        document.getElementById(div).className = 'b-item-glow';
        selected = div;
    }

    if(document.getElementById('char_hp').value == document.getElementById('char_max_hp').value) {
        document.getElementById('use_item').disabled = true;
    }

    else if(parseInt(item_quantity.innerHTML) == 0) {
        document.getElementById('use_item').disabled = true;
    }
    else {
        document.getElementById('use_item').disabled = false;
        document.getElementById('use_value').value = useage_value.value;
        document.getElementById('item_id').value = inv_id.value;
        document.getElementById('item_name').value = potion_name.value;
        document.getElementById('item_type').value = potion_type.value;
        document.getElementById('item_count').value = item_quantity.innerHTML;
    }
}

function hideButton()
{
    document.getElementById('button_show').className = 'button-hide';
    document.getElementById('button_hide').className = 'b-button-container';
}
