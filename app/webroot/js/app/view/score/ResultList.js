Ext.define('SIS.view.score.ResultList' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.scoreresultlist',

    title: '考试科目',
    store:'scores.StudentScores',
    
    autoload:true,
    stripeRows: true,
    dockedItems: [],
    renderGender:function(value){
	if(value==1){
		return "男";

	}else{
		return "女";
	}
	},	

    initComponent: function() {
//        this.store = {
//            fields: ['name', 'email'],
//            data  : [
//                {name: 'Ed',    email: 'ed@sencha.com'},
//                {name: 'Tommy', email: 'tommy@sencha.com'}
//            ]	
//        };
		
        this.columns = [
            {header: 'ID',  dataIndex: 'id',  flex: 1}, 
            {header:'学期'},
            {header: '课程名称',  dataIndex: 'course_plan_id',  flex: 1,
            	renderer : function(value, metaData, record) { // #2
					var coursePlansStore = Ext.getStore('coursePlans.CoursePlanLists');
					var courseinfo = coursePlansStore.findRecord('id', value);
					return courseinfo != null ? courseinfo.get('course_info') : value;
				}},            
            {header: '学号',  dataIndex: 'stu_number',  flex: 1},
            {header: '姓名',dataIndex: 'stu_number',
            	renderer : function(value, metaData, record) { // #2
					var studentsStore = Ext.getStore('Students');
					//console.log(studentSore);
					var student = studentsStore.findRecord('stu_number', value);
					return student != null ? student.get('stu_name') : value;
				}
            },
            {header:'平时',dataIndex:'regular',
            	editor: {
                    xtype: 'numberfield',
                    allowBlank: false,
                    minValue: 0,
                    maxValue: 100
                }
            },
            {header:'期中',dataIndex:'midterm'},
            {header:'期末',dataIndex:'final'},
            {header:'总评',dataIndex:'total'}
            //{header:'性别',dataIndex:'gender',flex:1,renderer:this.renderGender},
 
            
        ];
/*        this.bbar = Ext.create('Ext.PagingToolbar', {  
            store: this.store,  
            displayInfo: true,  
            displayMsg: '显示 {0} - {1} 共计 {2}',  
            emptyMsg: '没有记录',  
            items:[  
                '-', {  
                xtype: 'button',      
                text: '添加',  
                pressed: true,
                id:'add_score',
                enableToggle: true  
            },
            {  
                xtype: 'button',      
                text: '删除',  
                pressed: true,
                id:'delete_score',
                enableToggle: true  
            }]  
        });  
*/
        this.callParent(arguments);
    }
});