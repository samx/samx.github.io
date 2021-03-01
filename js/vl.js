var vl = {
	init:function(){
		vl.data.sign_in();
		//vl.data.goog_auth_check()
		//vl.data.thread_elements()
	},
	o:{
		content:{
			unviewed:{},
			viewed:{}
		}
	},
	data:{
		thread_elements:function(){
			if(typeof firefox == 'object'){
				const xh = require('xhr');
				var xhr = new xh.XMLHttpRequest();	
			}
			else var xhr = new XMLHttpRequest();	
				
			xhr.onreadystatechange = function(data) {
			  if (xhr.readyState == 4) {
				var thread_elements = JSON.parse(xhr.responseText.substr(4));			
								
				//thread_elements;									
			  }
			} 
			xhr.open('GET', "https://www.google.com/bookmarks/api/thread?op=ShowThread&threadID=GMMTuirVbnLU%2FBDSAnDAoQmcDiiK4m", true);
			xhr.send(); 
		},
		
		goog_auth_check:function()	{	
			if(typeof firefox == 'object'){
				const xh = require('xhr');
				var xhr = new xh.XMLHttpRequest();	
			}
			else var xhr = new XMLHttpRequest();	
				
			xhr.onreadystatechange = function(data) {
			  if (xhr.readyState == 4) {
				if (xhr.responseText.indexOf("SL.xt") !== -1) {
					goog_auth= true;
					token = xhr.responseText.split("SL.xt = '")[1].split("'")[0];
				//	action.goog_checkfor_viewlater_lists()
				} 
				else {
					goog_auth = false;
					//https://www.google.com/bookmarks/l
				}

				console.log(token)

			  }
			}   
			xhr.open('GET', "https://www.google.com/accounts/ServiceLogin?service=bookmarks&passive=true&nui=1&continue=https://www.google.com/bookmarks/l&followup=https://www.google.com/bookmarks/l", true);
			xhr.send(); 
			
		},
	
	
	
		sign_in:function(){
			if(typeof firefox == 'object'){
				const xh = require('xhr');
				var xhr = new xh.XMLHttpRequest();	
			}
			else var xhr = new XMLHttpRequest();	
				
			xhr.onreadystatechange = function(data) {
			  if (xhr.readyState == 4) {
				console.log(xhr.responseText);
			  }
			}   
			var param = "Email=samsono@gmail.com&GALX=gO9ZySkZYX0&Passwd=Edosa032171&PersistentCookie=yes&asts= &continue=https%3A%2F%2Fwww.google.com%2Fbookmarks%2Fl&dsh=-4572327023467669697 &followup=https%3A%2F%2Fwww.google.com%2Fbookmarks%2Fl&nui=1&rmShown=1&secTok=&service=bookmarks&signIn=Sign%20in&timeStmp="
			xhr.open('POST', "https://www.google.com/accounts/ServiceLoginAuth", true);
			xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
			xhr.send(param); 
		}
	}
}


vl.init();