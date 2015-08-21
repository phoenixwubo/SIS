function renderGender(value){
	if(value==1){
		return "男";

	}else{
		return "女";
	}
}	

var comboData=[
	['1','男'],
	['2','女']

]

var columns=[
	new Ext.grid.RowNumberer(),
	{header:'id',		dataIndex:'id'},
	{header:'性别',		dataIndex:'gender',	renderer:renderGender,editor:new Ext.form.ComboBox({
		store:new Ext.data.SimpleStore({
			fields:['value','text'],
			data:comboData
		}),
		emptyText:'请选择性别',
		mode:'local',
		triggerAction:'all',
		valueField:'value',
		editable:false
	})},
	{header:'姓名',		dataIndex:'fullname',	editor:{allowBlank:false}},
	{header:'出生日期',	dataIndex:'dob',type: 'date' ,   xtype: 'datecolumn',   format:'Y-m-d',
	editor:new Ext.form.DateField({
				format:'Y-m-d'})/*,
	renderer:function(value){
		return Ext.Date.format(value,"Y-m-d")}*/
	
	}
];	


var itemsPerPage = 10;   // set the number of items you want per page
var store=new Ext.data.Store({
	storeId: 'userInJson',	
	
	pageSize:itemsPerPage,
	fields:['id','fullname','gender','dob'],
	proxy:({
		type:'ajax',
		url:'paginateUser',
		reader:{
			type:'json',
			root:'userInJson',
			idProperty: 'id',
			totalProperty: 'totalUser'
		
	}
})
});


var sm=new Ext.selection.CheckboxModel();


var grid=new Ext.grid.Panel({
	title:'学生信息表',
	columns:columns,
	store:store,
	selModel:sm,
	bbar:new Ext.PagingToolbar({
		pageSize:itemsPerPage,
		store:store,
		displayInfo:true,
		displayMsg:'从第{0}条到第{1}，条共{2}条'
	}),
	plugins:[
		Ext.create('Ext.grid.plugin.CellEditing',{
			clicksToEdit:1
		})

		]
	,
	tbar:['-',{
		text:'增加一行',
		handler:function(){
			var p={
				id:'',
				name:'',
				gender:'',
				dob:''
			};
			store.insert(0,p)
		}
	},'-',{
		text:'删除选择的行',
		handler:function(){
			var selModel = grid.getSelectionModel();

			var record=selModel.getSelection();
			var countRecord=record.length;
			var names='';
			for(var i=0;i<countRecord;i++){
				if (i==countRecord-1){
					names+=record[i].get('fullname');
				}
				else {
					names+=record[i].get('fullname')+',';
				}
			}
			//recordNumber=record.getSelectionCount()
			Ext.Msg.confirm('信息','确定要删除?'+names+'记录？',function(btn,text){
				if(btn=='yes'){
					
					store.remove(record);
				}
			});/**/
		}
	},'-',{
		text:'全部删除',
		handler:function(){
				Ext.Msg.confirm({
					icon:Ext.MessageBox.WARNING ,
					title:'警告',
					msg:'确定删除所有记录？',	
					buttonText: {yes:'是',no:'否'},
					fn:function(btn,text){
						if(btn=='yes'){
							store.removeAll()
						}
						
					}});
		}
	}]


});
store.sort('gender','DESC');
store.load({
    params:{
        start:0,
        limit: itemsPerPage
    }
});