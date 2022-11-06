class TrieNode
{
    public $isEnd = false;
    public $word_count = 1;
    public $children = [];
}
 
class Trie {
    # Trie data structure class
    public $node = null;
 
    //Initializing trie
    public function __construct()
    {
        $this->node = new TrieNode();
    }
   
    // Inserts a word into the trie.
 
    public function insert($word)
    {
        $count = strlen($word);
        $node = $this->node;
        $node->word_count++; //Increase number of words added
        
        for ($i = 0; $i < $count; $i++) {
            $char = $word[$i];
            if (array_key_exists($char, $node->children)) {                
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
            if (!array_key_exists($char, $node->children)) {
                return 0;
            }
            $node = $node->children[$char];
        }
 
        return $node->word_count;
    }
}
 
function contacts($queries) {
    // Write your code here
    $contacts_db = new Trie();
    $results = [];

    foreach($queries as $query) {
        switch($query[0]) {
            case "add":
                if(isset($query[1])) {
                    $contacts_db->insert($query[1]);
                }
            break;
            case "find":
                if(isset($query[1])) {                                        
                    $search_count = $contacts_db->search($query[1]);
                    array_push($results,$search_count);
                }
            break;            
        }
    }
    return $results;
}
