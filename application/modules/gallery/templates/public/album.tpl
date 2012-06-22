<script src="{$THEME}/js/lightBox/js/jquery.lightbox-0.5-min.js"></script>
<link rel="stylesheet" type="text/css" href="{$THEME}/js/lightBox/css/jquery.lightbox-0.5-min.css" />
{literal}
    <script type="text/javascript">
    $(function(){
        $('a.lightbox').lightBox({fixedNavigation:true});
    })
    </script>
{/literal}
<div id="titleExt"><h5><a href="{site_url('gallery')}">Галерея</a> &gt;&gt; <span class="ext">{$album.name}</span></h5></div>

<div align="center">
<table cellpadding="1" cellspacing="1" border="0">
    <tr>
        <td colspan="2">
            <a href="{media_url($album_url . $prev_img.full_name)}" class="lightbox" title="{$prev_img.description}" >
                <img src="{media_url($prev_img.url)}" style="border:5px solid #E8E8E8;" />
            </a>  
        </td>
    </tr>
    <tr>
        <td>
            <span class="g_small">Изображение {$current_pos} из {count($album.images)}</span>
        </td>
        <td align="right">
            <span class="g_small"><a href="{site_url('gallery/thumbnails/' . $album.id)}">Все изображения</a></span>
        </td>
    </tr>
</table>

    {if $prev}<a id="gallery_nav" href="{site_url($album_link . 'image/'. $prev.id)}"#image>&lt;&lt;&nbsp;Предыдущая</a>&nbsp;&nbsp;{/if}
    {if $next}&nbsp;&nbsp;<a id="gallery_nav" href="{site_url($album_link . 'image/'. $next.id)}"#image>Следующая&nbsp;&gt;&gt;</a>{/if}
</div>

<br />

<div class="comments">
    {$comments}
</div>

<!-- Image info
    {$prev_img.full_name} / {$prev_img.width}x{$prev_img.height} / {$prev_img.file_size} / {date('Y-m-d H:i', $prev_img.uploaded)}
-->

<!-- Thumbs list
<div class="gallery_thumbs" align="center">
    <ul>
        {foreach $album.images as $image}
           <li>
           <a href="{site_url($album_link . 'image/'. $image.id)}#image" title="{$image.description}"><img src="{site_url($thumb_url . $image.full_name)}" alt="{$image.description}" /></a>
            <a style="display:none;" rel="lightbox[gallery]" href="{site_url($album_url . $image.full_name)}"></a>
           </li>
        {/foreach}
    </ul>
</div>
-->

