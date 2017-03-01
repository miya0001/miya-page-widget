# Miya Page Widget

[![Build Status](https://travis-ci.org/miya0001/miya-page-widget.svg?branch=master)](https://travis-ci.org/miya0001/miya-page-widget)

A WordPress plugin which displays the content in the widget.

![](https://www.evernote.com/l/ABWGF1ygaVdNkqa-4bs7AD7nHLeWqSbhJWoB/image.png)

## Sample HTML

```
<section class="page-2 page page-widget">
  <div class="page-widget-container">
    <div class="post-thumbnail">
      <a href="https://..."><img src="..."></a>
    </div>
    <div class="post-title">
      <a href="https://...">Sample Page</a>
    </div>
    <div class="post-excerpt">...</div>
  </div>
</section>
```

## Filter Hook

### page_widget_template

Filters the template of the HTML.

```
<section class="%class%"><div class="page-widget-container">
  <div class="post-thumbnail"><a href="%post_url%">%post_thumbnail%</a></div>
  <div class="post-title"><a href="%post_url%">%post_title%</a></div>
  <div class="post-excerpt">%post_excerpt%</div>
</div></section>
```

You can use following placeholders in the template.

* `%class%`
* `%post_url%`
* `%post_thumb%`
* `%post_title%`
* `%post_excerpt%`
