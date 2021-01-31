<!-- Header -->
<{include file='db:xsitemap_admin_header.tpl' }>

<{if $plugins_list|default:''}>
	<div align="right">
		<form id="form_plugin_tri" name="form_plugin_tri" method="post" action="plugin.php">
			<{$smarty.const._AM_XSITEMAP_PLUGIN_NAME}>
			<input type="text" id="title" name="title" value="<{$title}>" />
			<input type="submit" value="<{$smarty.const._GO}>" />
			<input type='button' name='reset'  id='reset' value='<{$smarty.const._RESET}>' onclick="location='plugin.php'" />
			<{$smarty.const._AM_XSITEMAP_PLUGIN_ONLINE}>
			<select name="plugin_filter" id="plugin_filter" onchange="location='plugin.php?title=<{$title}>&plugin_status='+this.options[this.selectedIndex].value">
				<{$plugin_status_options}>
			<select>
		</form>
	</div>
	<table class='table table-bordered'>
		<thead>
			<tr class='head'>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_ONLINE}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_NAME}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_VERSION_SHORT}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_MOD_TABLE_SHORT}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_CAT_ID_SHORT}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_CAT_PID_SHORT}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_CAT_NAME_SHORT}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_WEIGHT_SHORT}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_WHERE_SHORT}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_CALL_SHORT}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_SUBMITTER}></th>
				<th class="center"><{$smarty.const._AM_XSITEMAP_PLUGIN_DATE_CREATED}></th>
				<th class="center width5"><{$smarty.const._AM_XSITEMAP_FORMACTION}></th>
			</tr>
		</thead>
		<{if $plugins_count}>
		<tbody>
			<{foreach item=plugin from=$plugins_list}>
			<tr class="<{cycle values='even,odd'}> alignmiddle">
				<td class="xo-actions txtcenter">
                    <img id="loading_sml<{$plugin.plugin_id}>" src="../assets/images/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>"
                    alt="<{$smarty.const._AM_SYSTEM_LOADING}>"/><img class="cursorpointer tooltip" id="sml<{$plugin.plugin_id}>"
                    onclick="system_setStatus( { op: 'update_online_plugin', plugin_id: <{$plugin.plugin_id}> }, 'sml<{$plugin.plugin_id}>', 'plugin.php' )"
                    src="<{if $plugin.plugin_online == 1}><{xoAdminIcons success.png}><{else}><{xoAdminIcons cancel.png}><{/if}>"
                    alt="<{if $plugin.plugin_online}><{$smarty.const._AM_XSITEMAP_OFF}><{else}><{$smarty.const._AM_XSITEMAP_ON}><{/if}>"
                    title="<{if $plugin.plugin_online}><{$smarty.const._AM_XSITEMAP_OFF}><{else}><{$smarty.const._AM_XSITEMAP_ON}><{/if}>"/>
                </td>
				<td class='center'><{$plugin.plugin_name}></td>
				<td class='center'><{$plugin.plugin_mod_version}></td>
				<td class='center'><{$plugin.plugin_mod_table}></td>
				<td class='center'><{$plugin.plugin_cat_id}></td>
				<td class='center'><{$plugin.plugin_cat_pid}></td>
				<td class='center'><{$plugin.plugin_cat_name}></td>
				<td class='center'><{$plugin.plugin_weight}></td>
				<td class='center'><{$plugin.plugin_where}></td>
				<td class='center'><{$plugin.plugin_call}></td>
				<td class='center'><{$plugin.submitter}></td>
				<td class='center'><{$plugin.date_created}></td>


				<td class="center  width5">
					<a href="plugin.php?op=edit_plugin&amp;plugin_id=<{$plugin.plugin_id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}> plugins"></a>
					<a href="plugin.php?op=delete_plugin&amp;plugin_id=<{$plugin.plugin_id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}> plugins"></a>
				</td>
			</tr>
			<{/foreach}>
		</tbody>
		<{/if}>
	</table>
	<div class="clear">&nbsp;</div>
	<{if isset($pagenav)}>
		<div class="xo-pagenav floatright"><{$pagenav}></div>
		<div class="clear spacer"></div>
	<{/if}>
<{/if}>

<{if $form|default:''}>
	<{$form}>
<{/if}>

<{if $error|default:''}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>

<!-- Footer -->
<{include file='db:xsitemap_admin_footer.tpl' }>
