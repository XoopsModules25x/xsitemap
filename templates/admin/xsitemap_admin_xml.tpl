<!-- Header -->
<{includeq file='db:xsitemap_admin_header.tpl' }>

<{if $update|default:''}>
    <p style='margin-bottom: 2em;'><{$update}></p>
<{/if}>
<{if $file_exists|default:''}>
    <div>
        <p style="margin-bottom: 2em;"><span class="bold"><{$smarty.const._AM_XSITEMAP_XML_LOCATION}>:</span> <{$file_location}></p>
        <p style="margin-bottom: 2em;"><span class="bold"><{$smarty.const._AM_XSITEMAP_XML_LASTUPD}>:</span> <{$file_lastmod}></p>
        <p style="margin-bottom: 2em;"><span class="bold"><{$smarty.const._AM_XSITEMAP_XML_FILE_SIZE}>:</span> <{$file_size}></p>
    </div>
<{/if}>

<{if $form|default:''}>
    <{$form}>
<{/if}>
<{if $error|default:''}>
    <div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>

<!-- Footer -->
<{includeq file='db:xsitemap_admin_footer.tpl' }>
