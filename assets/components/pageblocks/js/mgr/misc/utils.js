PageBlocks.utils.getMenu=function(e,t,i){var a,l,s,o,n,r=[],c=!1;for(n in e)if(e.hasOwnProperty(n)){var u=e[n];if(!PageBlocks.grid.create){if("copyObject"==u.action)continue;if("disableObject"==u.action)continue;if("enableObject"==u.action)continue;if("removeObject"==u.action&&u.remove)continue}if(u.menu){if(0<r.length&&!c&&(/^remove/i.test(u.action)||/^delete/i.test(u.action))&&(r.push("-"),c=!0),1<i.length){if(!u.multiple)continue;"string"==typeof u.multiple&&(u.title=u.multiple)}l=u.icon||"","object"==typeof u.cls?void 0!==u.cls.menu&&(l+=" "+u.cls.menu):a=u.cls||"",s=u.title||u.title,o=u.action?t[u.action]:"",r.push({handler:o,text:String.format('<span class="{0}"><i class="x-menu-item-icon {1}"></i>{2}</span>',a,l,s),scope:t})}else"-"==u&&r.push("-")}return r},PageBlocks.utils.renderBoolean=function(e){return e?String.format('<span class="green">{0}</span>',_("yes")):String.format('<span class="red">{0}</span>',_("no"))},PageBlocks.utils.renderButton=function(e){return e.caption},PageBlocks.utils.previewImage=function(e){return Ext.isEmpty(e)?"":((e=/\/\//.test(e)||/^\//.test(e)?e:"/"+e).indexOf(".svg")||(e=MODx.config.connectors_url+"system/phpthumb.php?h=100&f=png&src="+e+"&source=1"),String.format('<img src="{0}" style="max-width:100%;height:100px;margin:10px auto"/>',e))},PageBlocks.utils.translitAlias=function(e,i){MODx.Ajax.request({url:MODx.config.connector_url,params:{action:"resource/translit",string:e},listeners:{success:{fn:function(e){let t=e.object.transliteration;Ext.isEmpty(t)||(t=t.replaceAll("-","_"),i.setValue(t))},scope:this}}})},PageBlocks.utils.renderImage=function(e){return Ext.isEmpty(e)?"":((e=/\/\//.test(e)||/^\//.test(e)?e:"/"+e).indexOf(".svg")||(e=MODx.config.connectors_url+"system/phpthumb.php?h=100&f=png&src="+e+"&source=1"),String.format('<img src="{0}" style="max-width:100%;height:auto;max-height:100px;margin:0"/>',e))},PageBlocks.utils.renderVideo=function(e,t,i){return Ext.isEmpty(e)?"":(/\/\//.test(e)||/^\//.test(e)||(e="/"+e),"video"==i?String.format('<video width="360" height="200" controls style="max-width:100%;margin:10px auto"><source src="{0}" type="video/mp4"></video>',e):String.format('<h3 style="margin:10px 0">{0}</h3><iframe width="360" height="200" style="max-width:100%;margin:10px auto" src="{1}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',t,e))},PageBlocks.utils.renderDate=function(e){return Ext.isEmpty(e)?"—":e},PageBlocks.utils.renderActions=function(e,t,i){var a,l,s,o,n=[];for(o in i.data.actions)if(i.data.actions.hasOwnProperty(o)){var r=i.data.actions[o];if(r.button){if(!PageBlocks.grid.create){if("copyObject"==r.action)continue;if("disableObject"==r.action)continue;if("enableObject"==r.action)continue;if("removeObject"==r.action&&r.remove)continue}s=r.icon||"","object"==typeof r.cls?void 0!==r.cls.button&&(s+=" "+r.cls.button):a=r.cls||"",l=r.action||"",r=r.title||"",s=String.format('<li class="{0}"><button class="pb-btn pb-btn-default {1}" action="{2}" title="{3}"></button></li>',a,s,l,r),n.push(s)}}return String.format('<ul class="pb-row-actions">{0}</ul>',n.join(""))},PageBlocks.utils.setDefaultValue=function(e,t){setTimeout(()=>{if(!Ext.isEmpty(t)&&!e.getValue()&&"function"==typeof e.setValue){switch(e.xtype){case"pb-combo-listbox-multiple":t=t.split("||");break;case"xcheckbox":t=+t}e.setValue(t)}},0)},PageBlocks.utils.renderRTE=function(e){e&&MODx.loadRTE&&MODx.loadRTE(e.id)},PageBlocks.utils.getXtype=function(l,i){let a=i&&i[l.name]?i[l.name]:"",s={xtype:l.type,fieldLabel:l.caption,name:l.name,id:"record-"+i.extid+"-"+l.name,cls:"field-"+l.type,anchor:"99.5%",width:"100%",allowBlank:!l.required,description:"<b>[[*"+l.name+"]]</b>",readOnly:l.readonly||0,record:a,listeners:{afterrender:function(e){PageBlocks.utils.setDefaultValue(e,l.default)}}};var e="3"===PageBlocks.config.modxversion?MODx.config:MODx.clientconfig;switch(l.source&&(l.media_source=PageBlocks.config.media_source[l.source]),l.source_path&&(t=i&&i.id?i.id:"temp"+l.id,l.openTo=l.media_source?l.media_source.baseUrl:"/",l.source_path=l.source_path.replace("[[+resource_id]]",PageBlocks.resource.id),l.source_path=l.source_path.replace("[[+id]]",t)),["name","title","pagetitle"].includes(l.name)&&(s.enableKeyEvents=1,s.listeners.keyup=function(e){var t;(!i.alias||Ext.isEmpty(i.alias))&&(e=Ext.util.Format.stripTags(e.getValue()),e=Ext.util.Format.htmlEncode(e),t=Ext.getCmp("record-"+i.extid+"-alias"))&&PageBlocks.utils.translitAlias(e,t)},s.listeners.blur=s.listeners.keyup),l.type){case"richtext":s.xtype="textarea",s.listeners.afterrender=function(e){PageBlocks.utils.setDefaultValue(e,l.default),PageBlocks.utils.renderRTE(e)};break;case"modx-texteditor":s.height=200,s.mimeType="text/x-smarty",s.modxTags=!0,s.listeners={render:function(e){"undefined"==e.getValue()&&e.setValue("")}};break;case"listbox":s.xtype="pb-combo-listbox",Ext.isEmpty(l.values)?(s.xtype="pb-combo-getlist",s.url=l.connector,s.displayField=l.displayfield,s.pageSize=l.limit,s.baseParams={action:l.processor,where:l.where,sort:l.sort,dir:l.dir,limit:0,displayfield:l.displayfield,combo:1}):(0===l.values.indexOf("++")&&(l.values=e[l.values.replace("++","")]),s.data=l.values);break;case"listbox-multiple":s.xtype="pb-combo-listbox-multiple",Ext.isEmpty(l.values)?(s.xtype="pb-combo-getlist-multiple",s.url=l.connector,s.displayField=l.displayfield,s.pageSize=l.limit,s.baseParams={action:l.processor,where:l.where,sort:l.sort,dir:l.dir,limit:0,displayfield:l.displayfield,combo:1}):(0===l.values.indexOf("++")&&(l.values=e[l.values.replace("++","")]),s.data=l.values),s.listeners={afterrender:function(e){setTimeout(()=>{Ext.isEmpty(a)||e.setValue(a)},500)}};break;case"resourcelist":s.xtype="pb-combo-resource",s.baseParams={action:"web/combo/resourcelist",where:l.where,sort:l.sort,dir:l.dir,limit:10,combo:1};break;case"combo-boolean":s.hiddenName=l.name,s.store=new Ext.data.SimpleStore({fields:["d","v"],data:[[_("yes"),1],[_("no"),0]]}),s.listeners.afterrender=function(e){PageBlocks.utils.setDefaultValue(e,l.default),Ext.isEmpty(a)||setTimeout(()=>{e.hiddenField.value=+a},100)};break;case"numberfield":s.inputType="number",s.cls="x-form-text",l.number_allownegative||(s.minValue=0),Ext.isEmpty(l.number_minvalue)||(s.minValue=l.number_minvalue),Ext.isEmpty(l.number_maxvalue)||(s.maxValue=l.number_maxvalue);break;case"xcheckbox":s.hideLabel=!0,s.boxLabel=l.caption,s.inputValue=+l.default||0,s.checked=+a,s.listeners={afterrender:function(e){a?e.setValue(+a):PageBlocks.utils.setDefaultValue(e,l.default)}};break;case"checkboxgroup":s.columns=+l.columns||1,s.items=[],s.name="",0===l.values.indexOf("++")&&(l.values=e[l.values.replace("++","")]),l.values.split("||").forEach(function(e){var t=(e=e.split("=="))[0],e=e[1]||e[0];s.items.push({xtype:"checkbox",boxLabel:t,inputValue:e,name:l.name+"[]",id:Ext.id(),checked:a?a.includes(e):l.default==e})});break;case"radiogroup":s.columns=+l.columns||1,s.items=[],s.name="",s.listeners={},0===l.values.indexOf("++")&&(l.values=e[l.values.replace("++","")]),l.values.split("||").forEach(function(e){e=e.split("==");s.items.push({boxLabel:e[0],inputValue:e[1]||e[0],name:l.name,id:Ext.id(),checked:a?a.includes(e[1]||e[0]):l.default==(e[1]||e[0]),listeners:{render:function(e){!Ext.isEmpty(l.default)&&Ext.isEmpty(e.inputValue)&&e.setValue(l.default)}}})});break;case"pb-panel-file":s.source=l.source,s.source_path=l.source_path||"/",s.allowedFileTypes=l.media_source.allowedFileTypes,s.openTo=l.openTo||"/",s.panel_help=l.help,l.help="";break;case"pb-panel-image":case"pb-panel-video":s.model_id=l.model_id||0,s.source=l.source,s.source_path=l.source_path||"/",s.allowedFileTypes=l.media_source.allowedFileTypes,s.openTo=l.openTo||"/",s.panel_help=l.help,l.help="",s.listeners={afterrender:function(a){setTimeout(function(){let i=document.getElementById(a.id+"-input");if(Ext.isEmpty(i.value)&&!Ext.isEmpty(l.default)){let t=new Image;t.src=MODx.config.base_url+l.default,t.onload=function(){i.value=l.default;var e=document.getElementById(a.id+"-info"),e=(e&&(e.value=JSON.stringify({url:l.default,width:t.width,height:t.height,title:l.default.split("/").pop()})),Ext.getCmp(a.id+"-preview"));e&&e.update(PageBlocks.utils.previewImage(l.default))}}},500)}};break;case"pb-panel-button":s.listeners={afterrender:function(t){setTimeout(function(){var e=document.getElementById(t.xtype_id);Ext.isEmpty(e.value)&&!Ext.isEmpty(l.default)&&(e.value=JSON.stringify({caption:l.default}),e=document.querySelector("#"+t.xtype_id+"-panel button"))&&(e.innerText=l.default)},500)}};break;case"xdatetime":s.dateFormat=MODx.config.manager_date_format,s.timeFormat=MODx.config.manager_time_format,s.startDay=parseInt(MODx.config.manager_week_start),s.dateWidth=l.hide_time?"100%":"70%",s.timeWidth=l.hide_time?0:"30%",s.hideTime=+l.hide_time,s.timeIncrement=+l.time_increment||15,s.minTimeValue=l.time_minvalue||void 0,s.maxTimeValue=l.time_maxvalue||void 0,l.disabled_dates&&(s.disabledDates=l.disabled_dates.split(",")),l.disabled_days&&(s.disabledDays=l.disabled_days.split(","));break;case"timefield":s.xtype="timefield",s.format=MODx.config.manager_time_format,s.increment=+l.time_increment||15,s.minValue=l.time_minvalue||void 0,s.maxValue=l.time_maxvalue||void 0;break;case"pb-table":s.record=i,s.model_type=l.model_type,s.model_id=i?i.id:0,s.constructor_id=l.table_id,s.field_id=l.id,s.table_columns=l.table_columns,s.panel_help=l.help,delete s.listeners;break;case"colorpalette":l.readonly?s.tpl=new Ext.XTemplate('<tpl for="."><label class="color-item"><input type="checkbox" disabled name="'+l.name+'[]" value="{.}" style="background-color:#{.}"/></label></tpl>'):s.tpl=new Ext.XTemplate('<tpl for="."><label class="color-item"><input type="checkbox" name="'+l.name+'[]" value="{.}" style="background-color:#{.}"/></label></tpl>'),delete s.anchor,s.listeners={},s.values=a,s.listeners.afterRender=function(e){PageBlocks.utils.setDefaultValue(e,l.default),Ext.ColorPalette.superclass.afterRender.call(this),a.length&&a.forEach(e=>{e=this.el.child('.color-item input[value="'+e+'"]');e&&(e.dom.checked=!0)})},l.values&&(s.colors=l.values.split("||"),s.colors.forEach((e,t)=>{e=(e=e.split("=="))[1]||e[0],s.colors[t]=e.replace("#","")}));break;case"colorpicker":s.xtype="textfield",s.cls="coloris",s.anchor="20%",s.listeners={change:{fn:MODx.fireResourceFormChange,scope:this},afterrender:function(e){PageBlocks.utils.setDefaultValue(e,l.default),Coloris({el:".coloris",wrap:!0,theme:"modx"+ColorPicker.config.modxversion,themeMode:"light",margin:5,format:"hex",formatToggle:!0,alpha:!0,swatchesOnly:!1,focusInput:!1,autoClose:!0,clearButton:{show:!0,label:_("delete")},swatches:[]}),setTimeout(()=>{e.container.dom.querySelector(".clr-field").style.color=e.value},500)}};break;case"readonly":s.xtype="textfield",s.readOnly=!0;break;case"pb-xtype":s.xtype=l.xtype,s.hiddenName=l.name,"modx-description"==l.xtype&&(s.listeners={},s.html=l.default)}var t=[s],o=(Ext.isEmpty(l.help)||t.push({xtype:"label",id:Ext.id(),cls:"desc-under",text:l.help}),[l.cls]);return 1==l.hide_time&&o.push("pb-hidden-time"),s={layout:"form",defaults:{msgTarget:"under"},columnWidth:1,labelAlign:"top",width:"100%",items:t,cls:o.join(" ")},s="3"===PageBlocks.config.modxversion?{layout:"form",width:"100%",cls:"x-panel modx3-resource-panel x-form-label-top",items:[s]}:s},PageBlocks.utils.buildFields=function(e,s){(s=s||{}).extid=Ext.id();let i=[],t=[],o=[],a=!1,l=100;return e.filter(e=>0!==e.tab_id).forEach(e=>{t[e.tab_rank]=e.tab_name}),e.filter(e=>0===e.tab_id).forEach(e=>{var t=PageBlocks.utils.getXtype(e,s);100==e.width?(i.push(t),a=!1):((l-=e.width)<0&&(a=!1,l=100-e.width),a||(i.push({layout:"column",items:[]}),a=!0),l<0?a=!0:i[i.length-1].items.push({columnWidth:e.width/100,layout:"form",width:"100%",defaults:{msgTarget:"under"},items:[t]}))}),t.length&&(t.forEach(t=>{let i=!1,a=[],l=100;e.filter(e=>e.tab_name===t).forEach(e=>{var t=PageBlocks.utils.getXtype(e,s);100==e.width?(a.push(t),i=!1):((l-=e.width)<0&&(i=!1,l=100-e.width),i||(a.push({layout:"column",items:[]}),i=!0),l<0?i=!0:a[a.length-1].items.push({columnWidth:e.width/100,layout:"form",width:"100%",defaults:{msgTarget:"under"},items:[t]}))}),o.push({title:t,layout:"anchor",items:a,hideMode:"offsets",defaults:{msgTarget:"under",border:!1}})}),i.push({xtype:"modx-tabs",deferredRender:!1,stateful:!0,id:Ext.id(),items:o})),i},PageBlocks.utils.request=function(e,t,i){MODx.Ajax.request({url:PageBlocks.config.connectorUrl,params:e,listeners:{success:{fn:function(e){"function"==typeof t&&t(e)},scope:this},failure:{fn:function(e){"function"==typeof i&&i(e)},scope:this}}})};