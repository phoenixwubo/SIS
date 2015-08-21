Ext.define('SIS.controller.ResultSheet',{
		extend:'Ext.app.Controller',
		views:['sheet.ResultSheet',
		       'score.SearchResult',
	           'elective.SearchResult'],
		stores:['electives.ElectiveResults','scores.ScoreSearchResults'],
//	    refs:[{
//	    	ref : 'ResultList',
//	    	selector:'resultlist'
//	    },{
//	    	ref:'electiveResultList',
//	    	selector:'electiveresultlist'
//	    }],
	    init:function(){
	    	this.control({
				'resultsheet button[id=search]':{
					click:this.searchStudent
				}
				
	    			});
	    	},
    	searchStudent:function(button){
//    		
    		console.log('搜索');
    		var panel=button.up('panel');
        	var stu_number=panel.down('textfield').getValue();
//        	var grid=this.getResultList();
        	var scoreStore=this.getStore('scores.ScoreSearchResults');
        	scoreStore.load({params:{stu_number:stu_number}});
        	var electiveStore=this.getStore('electives.ElectiveResults');
        	electiveStore.load({params:{stu_number:stu_number}});

        	
    	}}
);