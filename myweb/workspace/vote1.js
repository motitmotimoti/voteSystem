var p_rank_is_filled = {};//ランキングに登録済みか？ key: elm.id

function set_item(item_elm, target_elm) {
    /******************************************
ドラッグ可能要素をドロップ可能要素へセット
・引数
	item_elm：　ドラッグ可能要素のelement
	target_elm:　ドロップ可能要素のelement
    ********************************************/
    
    target_elm.innerText = item_elm.innerText;
    p_rank_is_filled[target_elm.id] = true;
    
    //元要素のイベント禁止
    item_elm.setAttribute("draggable", "false");
    item_elm.onclick = function(){};
    
    //背景色をスワップ
    var item_bgColor = document.defaultView.getComputedStyle(item_elm, "").getPropertyValue("background-color");
    item_elm.style.backgroundColor = document.defaultView.getComputedStyle(target_elm, "").getPropertyValue("background-color");
    target_elm.style.backgroundColor = item_bgColor;
    
    
}

function swap_element(item_elm, target_elm) {
    /******************************************
ドラッグ可能要素とドロップ可能要素を入れ替える
・引数
	item_elm：　ドラッグ可能要素のelement
	target_elm:　ドロップ可能要素のelement
    ********************************************/
    p_rank_is_filled[target_elm.id] = true;
    
    //elementをスワップ
    item_parent = item_elm.parentNode;
    target_parent = target_elm.parentNode;
    
    target_clone = target_elm.cloneNode(true);
    item_clone = item_elm.cloneNode(true);
    
    target_parent.replaceChild(item_clone, target_elm);
    item_parent.replaceChild(target_clone, item_elm);
    
    
    //背景色をスワップ
    var item_bgColor = document.defaultView.getComputedStyle(item_clone, "").getPropertyValue("background-color");
    item_clone.style.backgroundColor = document.defaultView.getComputedStyle(target_clone, "").getPropertyValue("background-color");
    target_clone.style.backgroundColor = item_bgColor;
}

window.onload = function() {
    //各ドラッグ要素へのイベント設定
    var els = document.getElementsByClassName("p_item");
    for (var i = 0; i < els.length; i++) {
	els[i].ondragstart = function(evt) {
	    var elm = evt.target;
	    evt.dataTransfer.setData('Text', elm.id);//ドラッグ中データをセット
	    evt.stopPropagation();//親要素へのイベント伝播を阻止
	};
	els[i].onclick = function(evt) {
	    var elm = evt.target;
	    for (var id in p_rank_is_filled) {
		if (p_rank_is_filled[id] == false) {
		    var target = document.getElementById(id);
		    set_item(elm, target);
		    return;
		} else if (!p_rank_is_filled[id]) {
		    console.error("p_rank_is_filled was not initialized.");
		    return;
		}
	    }
	};
	
	}
    
    //ドロップアエリアへのイベント設定
    var slots = document.getElementsByClassName("p_slot");
    for (var i = 0; i < slots.length; i++) {
	//DO_NOT: イベント内でiを使わないこと！
	slots[i].ondragenter = function(evt) {
			evt.preventDefault();//デフォルトイベント無効化
	};
	slots[i].ondragover = function(evt) {
	    evt.preventDefault();//デフォルトイベント無効化
	};
	slots[i].ondrop = function(evt) {
	    var target = evt.target;
	    var id = evt.dataTransfer.getData('Text');//ドラッグ中データを取得
	    var item = document.getElementById(id);
	    if(target) {
		set_item(item, target);
		//swap_element(item, target);
		
	    }
	    evt.preventDefault();
	    //console.log(i); // 3
		};
	
	p_rank_is_filled[slots[i].id] = false;
    }
    
};

