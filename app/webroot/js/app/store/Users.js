Ext.define('SIS.store.Users', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.User',
    storeId: 'users',
    autoLoad:true,
    pageSize:20,
    proxy: {
        type: 'ajax',
        api:{
			create:'users/add/',			
			read: 'users/',
			update:'users/edit/',
			destroy:'users/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'userInJson',
            totalProperty:'totalUser',
            successProperty: 'success'
        }
    }
    /*fields: ['name', 'email'],
    data: [
        {name: 'Ed',    email: 'ed@sencha.com'},
        {name: 'Tommy', email: 'tommy@sencha.com'}
    ]*/
});