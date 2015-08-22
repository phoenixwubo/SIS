Ext.define('SIS.store.users.UsersList', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.User',
    storeId: 'userslist',
    autoLoad:true,
    proxy: {
        type: 'ajax',
        url:'users/listUser/',
        
        reader: {
            type: 'json',
            root: 'userInJson',
            totalProperty:'totalUser',
            successProperty: 'success'
        }
    }
});