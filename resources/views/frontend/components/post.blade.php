
@section('title', $post->title.' | '.$siteInfo->sitename)
@section('meta_description', Str::limit($post->content, 150))
@section('meta_keywords', 'blog, '.$post->title)
