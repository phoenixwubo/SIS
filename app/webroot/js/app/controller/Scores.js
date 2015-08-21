Ext.define('SIS.controller.Scores', {
    extend: 'Ext.app.Controller',
    
    models: ['Score'],
    stores:['Scores',
            'Users',
            'departments.DepartmentsRead',
            'Semesters',
            'Courses',
            'scores.ScoreSearchResults',
            'electives.ElectiveResults',
            'scores.ScoreSections' ,
            'scores.ExamNames',
            'scores.ScoreTables',
            'scores.SubjectScores'],
    views:[
           'score.SubjectScoreList',
           'score.ScoreTable',
           'toolbar.AddEditDelete',
           'toolbar.Pagenate',
          // 'score.SearchResult',
//           'score.ResultSheet',
//           'score.ResultList'
//           'score.Edit',
//           'score.Add',
//           'score.Import',
          
           'toolbar.FiltScore',
           'score.ScoreSectionChart',
           'score.TryGrid'
           
    ],
    refs:[{
    	ref : 'ResultList',
    	selector:'resultlist'
    }],
    
    init:function(){
    	this.control({
			'scorelist': {
				beforerender: this.onPanelRendered
						},
			'tabcontainer > scorelist':{
				itemdblclick:this.getSubStore
			},
			'subjectscorelist button[id=save]':{
				click:this.saveGrid
			},
			'scoresectionchart button#search':{
				click:this.onStatScore
			},
			'subjectscorelist button#search':{
				click:this.onSearchSubjectScore
			},
			'scoretable button#search':{
				click:this.onGetScoreTable
			},
    			});
    	},
    	onPanelRendered:function(){
//    		console.log('Scorer');
    		var store=this.getScoresStore();
    		store.reload();
    	},
    	getSubStore:function(){
    		console.log('testtest！');
    		var grid=this.getScoreList();
    		var store=this.getScoresStore();
    		var sm=grid.getSelectionModel();
//    		console.log(score);
    		//um=score.getUser();
//    		console.log(sm);
//    		console.log(sm.getSelection()[0].data.score_name);
//    		console.log(sm.getSelection()[0].data.id);
    	},
    	saveGrid:function(){
    		console.log('保存！');
    		this.getScoresSubjectScoresStore().sync({  
    	        success: function(form, action) {
    		   		alert("成功");
    	   				},  
    	   		failure: function(form, action) {  
    	   			alert("更新失败");  
    	   			}  	
    	});
    	},
    	onStatScore:function(button){
    		
        	department_id=button.up('panel').down('#department').getValue();
        	semester_id=button.up('panel').down('#semester').getValue();
        	course_id=button.up('panel').down('#course').getValue();
        	exam_name=button.up('panel').down('#exam').getValue();
        	console.log(department_id,semester_id,course_id,exam_name);
        	var dept_number;

    		
//        	http://stackoverflow.com/questions/21171049/dynamically-generate-axis-and-series-in-extjs-4
        	
//        	var store=this.getStudentsStore();
        	var statStore=this.getScoresScoreSectionsStore();
        	
        	var newUrl='scores/stat_scores_section/'+department_id+'/'+semester_id+'/'+course_id+'/'+exam_name+'/';
        	console.log(newUrl);
        	Ext.Ajax.request({
        		url:newUrl,
        		success: function(response){
                    var data = Ext.decode(response.responseText);
                    statStore.model.setFields(data.departmentInJson);
                    var series = [];
                    var chart=button.up('panel').down('chart');
                    chart.surface.removeAll();
                    chart.series.clear();
//                    console.log(data);
                     for(var field in data.departmentInJson){
                       if(data.departmentInJson[field] !== 'section'){
                           chart.series.add({
                               type:'line',
                               xField:'section',
                               highlight: {
                                   size: 7,
                                   radius: 7
                               },
                               title:data.departmentInJson[field],
                               tips: {
                                   trackMouse: true,
                                   style: 'background: #FFF',
                                   height: 20,
                                   width : 150,
                                   showDelay: 0,
                                   dismissDelay: 0,
                                   hideDelay: 0,
                                   renderer: function(storeItem, item) {
                                	   var title = item.series.title;
                                       this.setTitle(title+'班'+storeItem.get('section') + '分数段: ' + storeItem.get(item.series.yField)+ '人');
                                   }
                               },
                               yField:data.departmentInJson[field]
                           });

                           series.push(data.departmentInJson[field]);
                           
                           
                    }
                     }
                           var mAxes = chart.axes.items;
//                           	console.log(mAxes);
                           for(var axis in mAxes){
                               if(mAxes[axis].type === "Numeric"){
                                   mAxes[axis].fields = series;
                                   mAxes[axis].maximum = data.maximum;
                                   mAxes[axis].minimum = data.minimum;
                               }
                           }
                         chart.axes.items = [];
                           chart.axes.items = mAxes;
                          chart.bindStore(statStore);
                          chart.redraw();
                          chart.refresh();
                          statStore.loadRawData(data.scoreSectionInJson, false);
                     /* */    },
                        failure: function(response){
                            Ext.Msg.alert('Error',response);
                        }

                    
                    
        	});
        	
//			statStore.getProxy().url=newUrl;
			
			
//			statStore.load();
			console.log(statStore);
/*    		Ext.Ajax.request({
    			url:'departments/view/'+department_id+'/',
    			params:{
    			username:user,
    			password:pass

    			
    		},
    		failure : function(conn, response, options,
    									eOpts) {
    								Ext.Msg.show( {
    									title : 'Error!',
    									msg : conn.responseText,
    									icon : Ext.Msg.ERROR,
    									buttons : Ext.Msg.OK
    								});
    							},
    		success : function(conn, response, options,
    									eOpts) {
    								var result = Ext.JSON.decode(
    										conn.responseText, true); // #1
    								if (!result) { // #2
    									result = {};
    									result.success = false;
    									result.msg = conn.responseText;
    								}
    								if (result.success) { // #3
    									dept_number=result.data.dept_number;
    									console.log(dept_number);
//    									store.on('beforeload', function (store, options) {
//
//    							            var new_params = { dept_number:dept_number };
//    							            Ext.apply(store.proxy.extraParams, new_params);
//    							        	
//
//
//    							        });
    									var newUrl='scores/stat_scores_section/'+department_id+'/';
    									statStore.getProxy().url=newUrl;
    									statStore.load();
//    									store.load({params:{start:0,page:1}});
    								} else {
    									Ext.Msg.show( {
    										title : 'Fail!',
    										msg : result.msg, // #6
    										icon : Ext.Msg.ERROR,
    										buttons : Ext.Msg.OK
    									});
    								}
    							}
    		});*/
    		
        	
    	},
    	onSearchSubjectScore:function(button){
    		console.log('成绩登记修改');
    		department_id=button.up('panel').down('#department').getValue();
    		department=button.up('panel').down('#department').getRawValue();
        	semester_id=button.up('panel').down('#semester').getValue();
        	semester=button.up('panel').down('#semester').getRawValue();
        	course_id=button.up('panel').down('#course').getValue();
        	course=button.up('panel').down('#course').getRawValue();
        	exam_name=button.up('panel').down('#exam').getValue();
        	exam=button.up('panel').down('#exam').getRawValue();
        	if(department_id==null || semester_id==null || course_id==null || exam_name==null){
        		alert('请选择筛选条件');
        		return;
        	}
        	if(exam_name=='total'){
        		alert('总评成绩自动生成，无法编辑！');
        		return;
        	}
        		console.log(department_id,semester_id,course_id,exam_name);
            	grid=button.up('panel').down('grid');
            	var combo=button.up('panel').down('#exam');
            	grid.setTitle(semester+department+course+exam+'成绩录入');
//            	console.log();
            	var store=this.getScoresSubjectScoresStore();
            	var columns=[{header:'班级',dataIndex:'dept_number',
    					renderer : function(value, metaData, record) { // #2
    					var departmentsStore = Ext.getStore('departments.DepartmentsRead');
    					//var str=String(value).substring(0,7);
    					//console.log(str);
    					var department = departmentsStore.findRecord('dept_number', value);
    					return department != null ? department.get('dept_name') : value;
    					}
    			 },
            	 {header: '学号',  dataIndex: 'stu_number'},
                 {header: '姓名',dataIndex: 'stu_name'}
    	 ];
    /*        	fields=['course_id','course_plan_id','stu_name','dept_number','stu_number'];
            	if(exam_name==null){
            		comboStore=combo.getStore();
            	comboStore.each(function(record) {fields.push(record.get('field')); }); 
            	}else{
            		fields.push(exam_name); 
            	}
            	
            	store.model.setFields(fields);*/

            	columns.push({header:exam,dataIndex:exam_name,
                   	editor: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0,
                        maxValue: 100
                    }
                });
            	grid.reconfigure(store,columns);
            	console.log(store.model.getFields());
            	store.on('beforeload', function (store, options) {

    			            var new_params = { department_id:department_id,semester_id:semester_id, course_id:course_id};
    			            Ext.apply(store.proxy.extraParams, new_params);
    			        	


    			        });
            	store.load({params:{start:0,page:1}});
            		
        	
        	
    	},
    	onGetScoreTable:function(button){
//    		console.log('成绩过滤');
    		//从combo获得信息
    		department_id=button.up('panel').down('#department').getValue();
    		department=button.up('panel').down('#department').getRawValue();
        	semester_id=button.up('panel').down('#semester').getValue();
        	semester=button.up('panel').down('#semester').getRawValue();
        	course_id=button.up('panel').down('#course').getValue();
        	course=button.up('panel').down('#course').getRawValue();
        	exam_name=button.up('panel').down('#exam').getValue();
        	exam=button.up('panel').down('#exam').getRawValue();
        	console.log(department_id,semester_id,course_id,exam_name);
        	combo=button.up('panel').down('#exam')
        	if(department_id==null || semester_id==null ){
        		alert('请选择筛选条件');
        		return;
        	}
        	if(course_id==null && exam_name==null){
        		alert('学科和考试名称必须选择一个！');
        		return;
        	}
        	var store=this.getScoresScoreTablesStore();
         	store.on('beforeload', function (store, options) {
	            var new_params = { department_id:department_id,semester_id:semester_id, course_id:course_id,exam_name:exam_name};
	            Ext.apply(store.proxy.extraParams, new_params);
	        });
        	store.load({params:{start:0,page:1}});
        	
        	var fields=['stu_name','dept_number','stu_number'];
        	var columns=[{header:'班级',dataIndex:'dept_number',
     					renderer : function(value, metaData, record) { // #2
 						var departmentsStore = Ext.getStore('departments.DepartmentsRead');
 						//var str=String(value).substring(0,7);
 						//console.log(str);
 						var department = departmentsStore.findRecord('dept_number', value);
 						return department != null ? department.get('dept_name') : value;
     					}
        			 },
		        	 {header: '学号',  dataIndex: 'stu_number'},
		             {header: '姓名',dataIndex: 'stu_name'}];
        	grid=button.up('panel').down('grid');
        	grid.setTitle(semester+department+course+exam+'成绩表');
        	var newUrl='courseplans/listCoursePlans/'+department_id+'/'+semester_id+'/'+course_id+'/';
        	Ext.Ajax.request({
        		url:newUrl,
        		success: function(response){
        			 var data = Ext.decode(response.responseText);
        			
        			 if(exam_name==null){
        				 comboStore=combo.getStore();
        	            	comboStore.each(function(record) {
        	            		fields.push(record.get('field')); 
        	            		columns.push({
               					 header: record.get('exam_name'),
               					dataIndex:record.get('field')
               						 });
        	            	}); 
        			 }
        			 else{
            			 for(var field in data.coursePlanInJson){
            				 fields.push(data.coursePlanInJson[field]['course_name']);
            				 columns.push({
            					 header:  data.coursePlanInJson[field]['course_name'],
            					 dataIndex:data.coursePlanInJson[field]['course_name']
            			 });
            			
            		}
        			 }
//        			 console.log(store.model.getFields());

        			  console.log(fields);
        			  store.model.setFields(fields);
        			  grid.reconfigure(store,columns);
        			  console.log(store.model.getFields());
        			  console.log(grid.columns);
        			  },
        	 failure: function(response){
                 Ext.Msg.alert('error',response);
             }
    	});
    	}
    	
        	

});
