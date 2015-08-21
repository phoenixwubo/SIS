Ext.define('SIS.view.score.ScoreTable' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.scoretable',

    title: '成绩表查询',
//    store:'scores.ScoreTables',
    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    autoload:false,
    stripeRows: true,
    dockedItems: [
                  {
                      xtype: 'filtscore'
                  },{
                	  xtype:'pagenate',  
                	  store: 'scores.ScoreTables'
                  }
                  
              ],
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
    	this.items=[{
            margin: '10 0 0 0',
            xtype: 'grid',
            flex: 1,
            columns: [],
            autoScroll:true,
            height:400,
            viewConfig: {
                emptyText: '请从上面的下拉框中选择筛选条件',
                deferEmptyText: false
            }
        }]
//        this.columns = [
//            /* {header: 'ID',  dataIndex: 'id',  flex: 1},     
//           {header: '课程名称',  dataIndex: 'course_plan_id',  flex: 1,
//            	renderer : function(value, metaData, record) { // #2
//					var coursePlansStore = Ext.getStore('coursePlans.CoursePlanLists');
//					var courseinfo = coursePlansStore.findRecord('id', value);
//					return courseinfo != null ? courseinfo.get('course_info') : value;
//				}},*/ 
//        //{header:'性别',dataIndex:'gender',flex:1,renderer:this.renderGender},	
//            {header:'班级',dataIndex:'dept_number',
//					renderer : function(value, metaData, record) { // #2
//						var departmentsStore = Ext.getStore('departments.DepartmentsRead');
//						//var str=String(value).substring(0,7);
//						//console.log(str);
//						var department = departmentsStore.findRecord('dept_number', value);
//						return department != null ? department.get('dept_name') : value;
//					}
//			},
//            {header: '学号',  dataIndex: 'stu_number'},
//            {header: '姓名',dataIndex: 'stu_name'},
//            {header:'语文',dataIndex:'语文'  },
////            {header:'期中',dataIndex:'midterm' },
////            {header:'期末',dataIndex:'final'},
////            {header:'总评',dataIndex:'total',            }
//
// 
//            
//        ];
        this.callParent(arguments);
    }
});