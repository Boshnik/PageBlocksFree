PageBlocks.window.listBlock=function(e){(e=e||{}).id||(e.id="pb-block-window-list"),Ext.applyIf(e,{title:_("pb_choise_block"),action:"web/block/create",buttons:[]}),PageBlocks.window.listBlock.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.window.listBlock,PageBlocks.window.Default,{getFields:function(e){let o=[{columnWidth:.33,items:[]},{columnWidth:.33,items:[]},{columnWidth:.33,items:[]}],t=0;return Ext.isArray(e.record)||(e.record=Object.values(e.record)),e.record.forEach(e=>{o[t++].items.push({xtype:"button",text:e.name,name:"block_"+Ext.id(),block_name:e.name,constructor_id:e.constructor_id,anchor:"100%",cls:"x-btn x-btn-small pb-block-btn",handler:this.getBlockFields,scope:this}),3===t&&(t=0)}),[{layout:"column",style:{margin:"15px 0"},items:o}]},getBlockFields:function(o,t){PageBlocks.utils.request({action:"mgr/field/getlist",model_type:"pbBlock",model_id:o.constructor_id,published:1,sort:"menuindex",dir:"asc"},e=>{this.close();e=MODx.load({xtype:"pb-block-window-create",record:[],block_fields:e.results,block_name:o.block_name,parent_id:0,id:Ext.id(),listeners:{success:function(){Ext.getCmp("pb-grid-blocks").refresh()}}});e.reset(),e.setValues({model_type:PageBlocks.resource.class_key,model_id:PageBlocks.resource.id,constructor_id:o.constructor_id,context_key:PageBlocks.resource.context_key||MODx.config.default_context,published:1}),e.show(t.target)})}}),Ext.reg("pb-block-window-list",PageBlocks.window.listBlock),PageBlocks.window.CreateBlock=function(e){(e=e||{}).id||(e.id="pb-block-window-create"),Ext.applyIf(e,{title:_("pb_row_create")+": "+e.block_name,cls:"modx-window pb-window",action:"web/block/create"}),PageBlocks.window.CreateBlock.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.window.CreateBlock,PageBlocks.window.Default,{getFields:function(e){let o=[{xtype:"hidden",name:"id",id:e.id+"-id"},{xtype:"hidden",name:"model_type",id:e.id+"-model_type"},{xtype:"hidden",name:"model_id",id:e.id+"-model_id"},{xtype:"hidden",name:"constructor_id",id:e.id+"-constructor_id"},{xtype:"hidden",name:"context_key",id:e.id+"-context_key"}];return Ext.isArray(e.record)&&(e.record=void 0),(o=o.concat(PageBlocks.utils.buildFields(e.block_fields,e.record))).push({xtype:"xcheckbox",hideLabel:!0,boxLabel:_("pb_grid_published"),name:"published",id:e.id+"-published",checked:!0}),o}}),Ext.reg("pb-block-window-create",PageBlocks.window.CreateBlock),PageBlocks.window.UpdateBlock=function(e){(e=e||{}).id||(e.id="pb-block-window-update"),Ext.applyIf(e,{title:_("pb_row_update")+": "+e.record.block_name,action:"web/block/update"}),PageBlocks.window.UpdateBlock.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.window.UpdateBlock,PageBlocks.window.CreateBlock),Ext.reg("pb-block-window-update",PageBlocks.window.UpdateBlock);