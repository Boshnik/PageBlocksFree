PageBlocks.window.CopyBlockId=function(e){(e=e||{}).id||(e.id="pb-copy-block-id"),Ext.applyIf(e,{title:_("pb_copy_block_id"),action:"web/block/copy",width:450,saveBtnText:_("pb_row_copy"),resizable:!1,collapsible:!1,constrainHeader:!1,maximizable:!1}),PageBlocks.window.CopyBlockId.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.window.CopyBlockId,PageBlocks.window.Default,{getFields:function(e){return[{xtype:"hidden",name:"model_type"},{xtype:"hidden",name:"model_id"},{xtype:"hidden",name:"context_key"},{xtype:"textfield",inputType:"number",cls:"x-form-text",minValue:1,fieldLabel:_("pb_copy_block_id_desc"),name:"id",hiddenName:"id",id:e.id+"-id",anchor:"99%",allowBlank:!1}]}}),Ext.reg("pb-copy-block-id",PageBlocks.window.CopyBlockId),PageBlocks.window.CopyBlocksResource=function(e){(e=e||{}).id||(e.id="pb-copy-blocks-resource"),Ext.applyIf(e,{title:_("pb_copy_blocks_resource"),action:"web/multiple",width:450,saveBtnText:_("pb_row_copy"),resizable:!1,collapsible:!1,constrainHeader:!1,maximizable:!1}),PageBlocks.window.CopyBlocksResource.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.window.CopyBlocksResource,PageBlocks.window.Default,{getFields:function(){return[{xtype:"hidden",name:"method_path"},{xtype:"hidden",name:"model_type"},{xtype:"hidden",name:"model_id"},{xtype:"hidden",name:"context_key"},{xtype:"pb-combo-resource",fieldLabel:_("pb_copy_blocks_resource_desc"),name:"resource_block_copying",allowBlank:!1},{xtype:"modx-combo-context",fieldLabel:_("context"),name:"context_from",hiddenName:"context_from",displayField:"name",valueField:"key",fields:["key","name"],id:Ext.id(),allowBlank:!1,hidden:0,baseParams:{action:"3"===PageBlocks.config.modxversion?"Context/GetList":"context/getlist",exclude:"mgr",sort:"rank",dir:"asc"},listeners:{afterrender:function(e){PageBlocks.utils.setDefaultValue(e,MODx.config.default_context)}}}]}}),Ext.reg("pb-copy-blocks-resource",PageBlocks.window.CopyBlocksResource),PageBlocks.window.CopyTablesResource=function(e){(e=e||{}).id||(e.id="pb-copy-tables-resource"),Ext.applyIf(e,{title:_("pb_copy_tables_resource"),action:"web/multiple",width:450,saveBtnText:_("pb_row_copy")}),PageBlocks.window.CopyTablesResource.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.window.CopyTablesResource,PageBlocks.window.Default,{getFields:function(e){return[{xtype:"hidden",name:"method_path"},{xtype:"hidden",name:"model_type"},,{xtype:"hidden",name:"model_id"},{xtype:"hidden",name:"context_key"},{xtype:"pb-combo-getlist",fieldLabel:_("pb_copy_tables_resource_desc"),name:"target",hiddenName:"target",id:e.id+"-target",anchor:"99%",allowBlank:!1,fields:["id","pagetitle"],displayField:"pagetitle",valueField:"id",baseParams:{action:"web/combo/resourcelist",sort:"id",dir:"asc",limit:10,combo:1}}]}}),Ext.reg("pb-copy-tables-resource",PageBlocks.window.CopyTablesResource);