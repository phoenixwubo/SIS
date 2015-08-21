/*Ext.define('SIS.store.Score',{
	extend:'Ext.data.JsonStore',
	fields: ['name', 'data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7', 'data9', 'data9'],
    data: generateData(),
    generateData : function(n, floor){
    var data = [],
        p = (Math.random() *  11) + 1,
        i;
        
    floor = (!floor && floor !== 0)? 20 : floor;
    
    for (i = 0; i < (n || 12); i++) {
        data.push({
            name: Ext.Date.monthNames[i % 12],
            data1: Math.floor(Math.max((Math.random() * 100), floor)),
            data2: Math.floor(Math.max((Math.random() * 100), floor)),
            data3: Math.floor(Math.max((Math.random() * 100), floor)),
            data4: Math.floor(Math.max((Math.random() * 100), floor)),
            data5: Math.floor(Math.max((Math.random() * 100), floor)),
            data6: Math.floor(Math.max((Math.random() * 100), floor)),
            data7: Math.floor(Math.max((Math.random() * 100), floor)),
            data8: Math.floor(Math.max((Math.random() * 100), floor)),
            data9: Math.floor(Math.max((Math.random() * 100), floor))
        });
    }
    return data;
}
});*/

Ext.define('SIS.store.Scores', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.Score',
    autoLoad:false,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
        api:{
			create:'scores/add/',			
			read: 'scores/',
			update:'scores/edit/',
			destroy:'scores/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'scoreInJson',
            totalProperty:'totalScore',
            successProperty: 'success'
        }
}
});