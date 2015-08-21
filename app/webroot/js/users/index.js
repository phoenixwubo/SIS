////使用真实数据
//
////Ext.onReady(function(){
////	//grid.render(Ext.getBody());
////	
////});
////var viewport=new Ext.Viewport({
////		layout:'border',
////		items:[{
////			region:'north',
////			html:'head'
////		},{
////			region:'center',
////			html:'grid'
////		},{
////			region:'east',
////			html:'form'
////				
////		},{
////			region:'sorth',
////			html:'foot'
////		}]
////	});
////Ext.onReady(function(){
//function renderGender(value){
//	if(value==1){
//		return "男";
//
//	}else{
//		return "女";
//	}
//}	
//
//var comboData=[
//	['1','男'],
//	['2','女']
//
//]
//
//var columns=[
//	new Ext.grid.RowNumberer(),
//	{header:'id',		dataIndex:'id'},
//	{header:'性别',		dataIndex:'gender',	renderer:renderGender,editor:new Ext.form.ComboBox({
//		store:new Ext.data.SimpleStore({
//			fields:['value','text'],
//			data:comboData
//		}),
//		emptyText:'请选择性别',
//		mode:'local',
//		triggerAction:'all',
//		valueField:'value',
//		editable:false
//	})},
//	{header:'姓名',		dataIndex:'fullname',	editor:{allowBlank:false}},
//	{header:'出生日期',	dataIndex:'dob',type: 'date' ,   xtype: 'datecolumn',   format:'Y-m-d',
//	editor:new Ext.form.DateField({
//				format:'Y-m-d'})/*,
//	renderer:function(value){
//		return Ext.Date.format(value,"Y-m-d")}*/
//	
//	}
//];	
//
//
//var itemsPerPage = 10;   // set the number of items you want per page
//var store=new Ext.data.Store({
//	storeId: 'userInJson',	
//	
//	pageSize:itemsPerPage,
//	fields:['id','fullname','gender','dob'],
//	proxy:({
//		type:'ajax',
//		url:'paginateUser',
//		reader:{
//			type:'json',
//			root:'userInJson',
//			idProperty: 'id',
//			totalProperty: 'totalUser'
//		
//	}
//})
//});
//
//
//var sm=new Ext.selection.CheckboxModel();
//
//
//var grid=new Ext.grid.Panel({
//	title:'学生信息表',
//	columns:columns,
//	store:store,
//	selModel:sm,
//	bbar:new Ext.PagingToolbar({
//		pageSize:itemsPerPage,
//		store:store,
//		displayInfo:true,
//		displayMsg:'从第{0}条到第{1}，条共{2}条'
//	}),
//	plugins:[
//		Ext.create('Ext.grid.plugin.CellEditing',{
//			clicksToEdit:1
//		})
//
//		]
//	,
//	tbar:['-',{
//		text:'增加一行',
//		handler:function(){
//			var p={
//				id:'',
//				name:'',
//				gender:'',
//				dob:''
//			};
//			store.insert(0,p)
//		}
//	},'-',{
//		text:'删除选择的行',
//		handler:function(){
//			var selModel = grid.getSelectionModel();
//
//			var record=selModel.getSelection();
//			var countRecord=record.length;
//			var names='';
//			for(var i=0;i<countRecord;i++){
//				if (i==countRecord-1){
//					names+=record[i].get('fullname');
//				}
//				else {
//					names+=record[i].get('fullname')+',';
//				}
//			}
//			//recordNumber=record.getSelectionCount()
//			Ext.Msg.confirm('信息','确定要删除?'+names+'记录？',function(btn,text){
//				if(btn=='yes'){
//					
//					store.remove(record);
//				}
//			});/**/
//		}
//	},'-',{
//		text:'全部删除',
//		handler:function(){
//				Ext.Msg.confirm({
//					icon:Ext.MessageBox.WARNING ,
//					title:'警告',
//					msg:'确定删除所有记录？',	
//					buttonText: {yes:'是',no:'否'},
//					fn:function(btn,text){
//						if(btn=='yes'){
//							store.removeAll()
//						}
//						
//					}});
//		}
//	}]
//
//
//});
//store.sort('gender','DESC');
//store.load({
//    params:{
//        start:0,
//        limit: itemsPerPage
//    }
//});
//var viewport=new Ext.Viewport({
//	layout:'border',
//	
//	items:[grid]
//});
//var panel=new Ext.panel.Panel({
//	//width: 500,
//	height: 300,
//	title: 'Border Layout',
//	layout: 'fit',
//	items:[grid]
//	});
//panel.render(Ext.getBody());
//});
//测试程序是否可用

Ext.onReady(function(){
	var store =new Ext.data.JsonStore({
		fields:['id','name','info','created'],
		data:[
			{id:1,name:'aitch',info:'Funny man',created:'2011/02/08'},
			{id:2,name:'david',info:'Canon man',created:'2011/02/08'},
			{id:3,name:'john',info:'Decent man',created:'2011/02/08'},
		]
	});

	 var columns =[
			{header:'id',		dataIndex:'id',		width:20},
			{header:'name',		dataIndex:'name',	width:50},
			{header:'info',		dataIndex:'info',	width:80},
			{header:'created',	dataIndex:'created',width:80}
		];
		


	var grid = new Ext.grid.GridPanel({
		title:'GridPanel',
		width:240,
		height:120,
		store:store,
		viewConfig:{
			forceFit:true
		},
		
		columns:columns
		//	renderTo:container
	});

	grid.render(Ext.getBody());
});


//Ext.onReady(function(){  
//    //定义列  
//    var columns = [  
//        {header:'编号',dataIndex:'id'}, //sortable:true 可设置是否为该列进行排序  
//        {header:'名称',dataIndex:'name'},  
//        {header:'描述',dataIndex:'descn'}  
//      ];  
//    //定义数据  
//    var data =[  
//        ['1','张三','描述01'],  
//        ['2','李四','描述02'],  
//        ['3','王五','描述03'],  
//        ['4','束洋洋','思考者日记网'],  
//        ['5','高飞','描述05']  
//    ];  
//    //转换原始数据为EXT可以显示的数据  
//    var store = new Ext.data.ArrayStore({  
//        data:data,  
//        fields:[  
//           {name:'id'}, //mapping:0 这样的可以指定列显示的位置，0代表第1列，可以随意设置列显示的位置  
//           {name:'name'},  
//           {name:'descn'}  
//        ]  
//    });  
//    //加载数据  
//    store.load();  
//      
//    //创建表格  
//    var grid = new Ext.grid.GridPanel({  
//        renderTo:Ext.getBody(), //渲染位置  
//        store:store, //转换后的数据  
//        columns:columns, //显示列  
//        stripeRows:true, //斑马线效果  
//        //enableColumnMove: false, //禁止拖放列  
//        //enableColumnResize: false, //禁止改变列宽度  
//        loadMask:true, //显示遮罩和提示功能,即加载Loading……  
//        forceFit:true //自动填满表格  
//    });  
//});  