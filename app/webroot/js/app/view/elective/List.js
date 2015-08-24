Ext.define('SIS.view.elective.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.electivelist',

    title: '选修课',
//    store:'electives.Electives',
    dockedItems: [
                  {
                      xtype: 'filtelecticourse',
                  },   {
                    	  xtype:'pagenate',
                    	  store: 'electives.Electives',items:[  
                    	                         '-', {  
                    	                             xtype: 'button',      
                    	                             text: '保存',  
                    	                             pressed: true,
                    	                             id:'saveElective',
                    	                             enableToggle: true  
                    	                         }]
                  }],
    autoload:true,
    stripeRows: true,
	plugins: [
	          Ext.create('Ext.grid.plugin.CellEditing', {
	              clicksToEdit: 1
	          })
	      ],
    initComponent: function() {
    	this.columns = [
//    	                     {header: 'ID',  dataIndex: 'id',  flex: 1},  
    	                     {header: '学期',  
    	                        	dataIndex: 'semester_id',
    	                        	flex: 1,
    								renderer : function(value, metaData, record) { // #2
    									var semestersStore = Ext.getStore('Semesters');
    									var semester = semestersStore.findRecord('id', value);
    									return semester != null ? semester.get('sem_name') : value;
    								}},
//    	                     {header: '课时序号',  dataIndex: 'lesson_number',  flex: 1},
    	                    
    	                     {header: '学号',  dataIndex: 'stu_number',  flex: 1},
    	                     {header: '姓名',  dataIndex: 'stu_name',  flex: 1},
    	                      {header: '课程名称',  dataIndex: 'course_id',  flex: 1,
    	                    	 renderer : function(value, metaData, record) { 
    									var coursesStore = Ext.getStore('courses.CoursesList');
    									var course = coursesStore.findRecord('id', value);
    									return course != null ? course.get('course_name') : value==0 ? "<span style='color:red;'>未选择</span>":value;
    								},
    	                    	 editor: {
    	                             xtype: 'combobox',
    	                             displayField:'course_name',
           							valueField:'id',
    	                             store:'courses.CoursesList',
    	                             allowBlank: false,
    	                             minValue: 0,
    	                             maxValue: 100
    	                         }}];
//    	 this.bbar = Ext.create('Ext.PagingToolbar', {  
//             store: this.store,  
//             displayInfo: true,  
//             displayMsg: '显示 {0} - {1} 共计 {2}',  
//             emptyMsg: '没有记录', {  
//                 xtype: 'button',      
//                 text: '保存',  
//                 pressed: true,
//                 id:'save',
//                 enableToggle: true  
//             }
//         });  
        this.callParent(arguments);

    	                     

    	                     
    }
});