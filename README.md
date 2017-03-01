# Singuar Widget

[![Build Status](https://travis-ci.org/miya0001/singular-widget.svg?branch=master)](https://travis-ci.org/miya0001/singular-widget)

A WordPress plugin which displays the single content in the widget.

![](https://www.evernote.com/l/ABWGF1ygaVdNkqa-4bs7AD7nHLeWqSbhJWoB/image.png)

## Sample HTML

```
<section class="page-2 page singular-widget">
  <div class="singular-widget-container">
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

### singular_widget_template

Filters the template of the HTML.

```
<section class="%class%"><div class="singular-widget-container">
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
