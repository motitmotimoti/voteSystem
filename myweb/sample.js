var vote_system = {};
vote_system.canvases = {};
vote_system.update_options = function(){
  var selects = vote_system.selects[this.dataset.category];
  for(let select_i = 0; select_i < selects.length; select_i++){
    let options = selects[select_i].children;
    for(let option_i = 0; option_i <options.length; option_i++){
      options[option_i].style.display = "inline";
    }
  }
  
  for(let select_i = 0; select_i < selects.length; select_i++){
    let selected_name = selects[select_i].selectedOptions[0].value;
    if(selected_name == "null")
      continue;
    for(let select_j = 0; select_j < selects.length - 1; select_j++){
      let options = selects[(select_j < select_i) ? select_j : select_j + 1].children;
      for(let option_i = 0; option_i < options.length; option_i++){
        if(options[option_i].value == selected_name)
          options[option_i].style.display = "none";
      }
    }
  }
};

vote_system.exchange = function(category, n){
  var selects = [vote_system.selects[category][n], vote_system.selects[category][n+1]];
  var option_names = [selects[0].selectedOptions[0].value, selects[1].selectedOptions[0].value];
  for(let option_i = 0; option_i < selects[0].children.length; option_i++){
    if(selects[0].children[option_i].value == option_names[1])
      selects[0].children[option_i].selected = true;
  }
  for(let option_i = 0; option_i < selects[1].children.length; option_i++){
    if(selects[1].children[option_i].value == option_names[0])
      selects[1].children[option_i].selected = true;
  }
  vote_system.selects[category][n].onchange();
};

vote_system.vote = function(){
  this.disabled = "disabled";
  var exchange_buttons = document.getElementsByClassName("exchange");
  for(let exchange_i = 0; exchange_i < exchange_buttons.length; exchange_i++)
    exchange_buttons[exchange_i].disabled = "disabled";
  document.getElementById("result-container").style.display = "block";
  
  //コンペ用クライアントサイド処理 ここから
  var results = [{category: "presenter", ranking: []}, {category: "facilitator", ranking: []}];
  for(let category_i = 0; category_i < results.length; category_i++){
    let selects = vote_system.selects[results[category_i].category];
    for(let select_i = 0; select_i < selects.length; select_i++){
      let name = selects[select_i].selectedOptions[0].innerHTML.replace(/\d+\./, "");
      results[category_i].ranking.push({point: 3 - select_i, name: name});
    }
    let options = selects[0].children;
    for(let option_i = 0; option_i < options.length; option_i++){
      if(options[option_i].value == "null")
        continue;
      let selected = false;
      for(let select_i = 0; select_i < selects.length; select_i++){
        if(options[option_i].value == selects[select_i].selectedOptions[0].value){
          selected = true;
          break;
        }
      }
      if(!selected)
        results[category_i].ranking.push({point: 0, name: options[option_i].innerHTML.replace(/\d+\./, "")});
    }
  }
  vote_system.display_results(results);
  //コンペ用クライアントサイド処理 ここまで
  
  var selects = document.getElementsByClassName("name-select");
  for(let select_i = 0; select_i < selects.length; select_i++)
    selects[select_i].disabled = "disabled";
};

vote_system.display_results = function(results){
  for(let category_i = 0; category_i < results.length; category_i++){
    let category = results[category_i].category;
    if(!this.canvases.category){
      this.canvases[category] = document.createElement("canvas");
      this.canvases[category].width = 320;
      this.canvases[category].height = 240;
    }
    let context = this.canvases[category].getContext("2d");
    context.fillStyle = "#ffffff";
    context.fillRect(0, 0, 320, 240);
    let ranking = results[category_i].ranking;
    let max_pt = 0;
    for(let person_i = 0; person_i < ranking.length; person_i++){
      if(ranking[person_i].point > max_pt)
        max_pt = ranking[person_i].point;
    }
    for(let person_i = 0; person_i < ranking.length; person_i++){
      context.fillStyle = "#000000";
      context.font = "20px sans-serif";
      context.textAlign = "center";
      context.textBaseline = "middle";
      context.fillText(ranking[person_i].name, 50, 28 + 46*person_i);
      context.fillText(ranking[person_i].point + "pt", 290, 28 + 46*person_i);
      context.fillStyle = "#009900";
      context.fillRect(100, 10 + 46*person_i, 160/max_pt*ranking[person_i].point, 36);
    }
    document.getElementById(category + "-result").src = this.canvases[category].toDataURL();
  }
};

window.onload = function(){
  vote_system.selects = {presenter: [], facilitator: []};
  var selects = document.getElementsByClassName("name-select");
  for(let i = 0; i < selects.length; i++){
    selects[i].onchange = vote_system.update_options;
    if(i < Math.floor(selects.length/2))
      vote_system.selects.presenter.push(selects[i]);
    else
      vote_system.selects.facilitator.push(selects[i]);
  }
  
  var exchange_buttons = document.getElementsByClassName("exchange");
  for(let i = 0; i < exchange_buttons.length; i++){
    let buttons_half_num = Math.floor(exchange_buttons.length/2);
    let n = (i < buttons_half_num) ? i : i%buttons_half_num;
    exchange_buttons[i].onclick = function(){
      vote_system.exchange(exchange_buttons[i].dataset.category, n);
    };
  }
  
  document.getElementById("vote").onclick = vote_system.vote;
};
