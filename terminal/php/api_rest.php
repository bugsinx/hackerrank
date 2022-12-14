/*
 * Complete the 'getAuthorHistory' function below.
 *
 * The function is expected to return an ARRAY of STRINGS.
 * The function accepts STRING author as parameter.
 *
 * Base urls:
 *   https://jsonmock.hackerrank.com/api/article_users?username=
 *   https://jsonmock.hackerrank.com/api/articles?author=
 */

function getAuthorHistory($author) {

    $history = array();
    
    //Query article user info
    $url_api_article_user = "https://jsonmock.hackerrank.com/api/article_users?username=".$author;
    
    $article_user_query_response = file_get_contents($url_api_article_user);
    
    $article_user_query_response = json_decode($article_user_query_response);
    
    //Store about field only if it is not empty or null
    if(!empty($article_user_query_response->data[0]->about)) {
        $about_field = $article_user_query_response->data[0]->about;    
        array_push($history,$about_field."\n");
    }
    
    $articles_response = getArticlesTitles($author);
    $history = array_merge($history,$articles_response->data);          

    while($articles_response->current_page < $articles_response->total_pages) {
        $articles_response = getArticlesTitles($author,$articles_response->current_page +1);
        $history = array_merge($history,$articles_response->data);  
    }

     return implode($history);
    
}

function getArticlesTitles($author,$page = 1) {
    
    $response = new stdClass();
    $response->data = array();
    
    //Query articles
    $url_api_articles = "https://jsonmock.hackerrank.com/api/articles?author=".$author."&page=".$page;

    $articles_query_response = file_get_contents($url_api_articles);
    
    $articles_query_response = json_decode($articles_query_response);
            
    //Add titles to $history array    
    
    //Get pagination info
    $response->total_pages = $articles_query_response->total_pages;
    $response->current_page = $articles_query_response->page;
        
        
    foreach($articles_query_response->data  as $article) {
        if(!empty($article->title)) {
            array_push($response->data,$article->title."\n");
        }
        else if (!empty($article->story_title)) {
            array_push($response->data,$article->story_title."\n");
        }
    }        
    
    return $response;
}


$result = getAuthorHistory("vladikoff");
