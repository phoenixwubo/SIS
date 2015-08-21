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
		
	// });

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

/*
Ext.onReady(function(){  
    //定义列  
    var columns = [  
        {header:'编号',dataIndex:'id'}, //sortable:true 可设置是否为该列进行排序  
        {header:'名称',dataIndex:'name'},  
        {header:'描述',dataIndex:'descn'}  
      ];  
    //定义数据  
    var data =[  
        ['1','张三','描述01'],  
        ['2','李四','描述02'],  
        ['3','王五','描述03'],  
        ['4','束洋洋','思考者日记网'],  
        ['5','高飞','描述05']  
    ];  
    //转换原始数据为EXT可以显示的数据  
    var store = new Ext.data.ArrayStore({  
        data:data,  
        fields:[  
           {name:'id'}, //mapping:0 这样的可以指定列显示的位置，0代表第1列，可以随意设置列显示的位置  
           {name:'name'},  
           {name:'descn'}  
        ]  
    });  
    //加载数据  
    store.load();  
      
    //创建表格  
    var grid = new Ext.grid.GridPanel({  
        renderTo:Ext.getBody(), //渲染位置  
        store:store, //转换后的数据  
        columns:columns, //显示列  
        stripeRows:true, //斑马线效果  
        //enableColumnMove: false, //禁止拖放列  
        //enableColumnResize: false, //禁止改变列宽度  
        loadMask:true, //显示遮罩和提示功能,即加载Loading……  
        forceFit:true //自动填满表格  
    });  
});  */