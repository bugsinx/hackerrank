<?php

/*
 * Complete the 'contacts' function below.
 *
 * The function is expected to return an INTEGER_ARRAY.
 * The function accepts 2D_STRING_ARRAY queries as parameter.
 */

 class TrieNode
{
    public $isEnd = false;
    public $word_count = 1;
    public $children = array();
}
 
class Trie {
    # Trie data structure class
    public $node = null;
 
    //Initializing trie
    public function __construct()
    {
        $this->node = new TrieNode();
//        $this->children = array_fill_keys( array('a', 'b', 'c', 'd', 'e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'), null);
    }
   
    // Inserts a word into the trie.
 
    public function insert($word)
    {
        $count = strlen($word);
        $node = $this->node;
        $node->word_count++; //Increase number of words added        

        for ($i = 0; $i < $count; $i++) {
            $char = $word[$i];
//            if (array_key_exists($char, $node->children)) {                
              if (isset($node->children[$char])) {
                $node = $node->children[$char];
                $node->word_count++;
                continue;
            }            
            $node->children[$char] = new TrieNode();
            $node = $node->children[$char];
        }
        
        $node->isEnd = true;
    }
   
    // Returns if the word is in the trie.
      
    public function search($word): int
    {
        $count = strlen($word);
        $node = $this->node;        
        
        for ($i = 0; $i < $count; $i++) {
            $char = $word[$i];
//            if (!array_key_exists($char, $node->children)) {
              if(!isset($node->children[$char])) {
                return 0;
            }
            $node = $node->children[$char];
        }
 
        return $node->word_count;
    }
}
 
function contacts($queries) {
    // Write your code here  
    //$contacts_db=array_fill_keys( array('a', 'b', 'c', 'd', 'e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'), null);
    $contacts_db = [[]];
    $results = [];
                
    foreach($queries as $query) {
        switch($query[0]) {
            case "add":
                if(isset($query[1])) {                    
                    if(!isset($contacts_db[$query[1][0]])) {
                        $contacts_db[$query[1][0]] = new Trie();
                    }
                    $contacts_db[$query[1][0]]->insert($query[1]);

                }
            break;
            case "find":            
                if(isset($query[1])) { 
                    $search_count=0;
                    if(isset($contacts_db[$query[1][0]])) {                                              
                        $search_count = $contacts_db[$query[1][0]]->search($query[1]);
                    }
                    array_push($results,$search_count);
                }                
            break;            
        }
    }
    return $results;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$queries_rows = intval(trim(fgets(STDIN)));

$queries = array();

for ($i = 0; $i < $queries_rows; $i++) {
    $queries_temp = rtrim(fgets(STDIN));

    $queries[] = preg_split('/ /', $queries_temp, -1, PREG_SPLIT_NO_EMPTY);
}

$result = contacts($queries);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($fptr);
