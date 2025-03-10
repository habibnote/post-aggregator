<?php
/**
 * Helper Functon To Calculate jaccard similarity
 * 
 * @return // Jaccard similarity 0 > < 1  
 */
if( ! function_exists( 'jaccard_similarity' ) ) {
    function jaccard_similarity( $text1, $text2 ) {
        
        $set1 = preprocess( $text1 );
        $set2 = preprocess( $text2 );
    
        // Calculate intersection and union
        $intersection = count( array_intersect( $set1, $set2 ) );
        $union = count( array_merge( $set1, $set2 ) );
    
        return $union ? $intersection / $union : 0;
    }
}

/**
 * Helper function to preprocess the content for checking similarity
 * 
 * @return //unique words
 */
if( ! function_exists( 'preprocess' ) ) {
    function preprocess( $text ) {
        // Convert to lowercase and split into words
        $words = preg_split( '/\s+/', strtolower( $text ) );
    
        // Remove non-alphabetical characters and stopwords
        $stopwords = list_non_alphabetical_char_and_stowords();

        $cleaned_words = array_filter( $words, function ( $word ) use ( $stopwords ) {
            return !in_array( $word, $stopwords ) && ctype_alpha( $word );
        });
    
        return array_unique($cleaned_words);
    }
}

/**
 * List of non-alphabetical characters and stopwords
 */
if( ! function_exists( 'list_non_alphabetical_char_and_stowords' ) ) {

    function list_non_alphabetical_char_and_stowords() {
        return ['a', 'about', 'above', 'after', 'again', 'against', 'all', 'am', 'an', 'and', 'any', 'are', 'aren\'t', 'as', 
        'at', 'be', 'because', 'been', 'before', 'being', 'below', 'between', 'both', 'but', 'by', 'can', 'can\'t', 'cannot', 'could',
        'couldn\'t', 'did', 'didn\'t', 'does', 'doesn\'t', 'don\'t', 'down', 'during', 'each', 'few', 'for', 'from', 'further', 'had', 
        'hadn\'t', 'has', 'hasn\'t', 'haven\'t', 'having', 'he', 'he\'s', 'her', 'here', 'hers', 'herself', 'how', 'how\'s', 'i', 'i\'m', 'i\'ve',
        'if', 'in', 'is', 'isn\'t', 'it', 'it\'s', 'it\'ll', 'it\'d', 'it\'ve', 'its', 'let', 'me', 'more', 'must', 'no', 'nor', 'not', 
        'off', 'on', 'once', 'only', 'or', 'other', 'ought', 'our', 'ours', 'ourselves', 'out', 'over', 'own', 'same', 'she', 'should',
        'so', 'than', 'that', 'that\'s', 'the', 'they', 'they\'re', 'this', 'those', 'through', 'to', 'too', 'under', 'until', 'up', 'very', 'was',
        'we', 'we\'re', 'what', 'what\'s', 'when', 'where', 'which', 'who', 'who\'s', 'why', 'why\'s', 'with', 'won\'t', 'would', 'you', 'you\'re',
        'your', 'yours', 'yourselves', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!', '"', '#', '$', '%', '&', "'", '(', ')', '*', '+', ',', '-', '.', '/', ':', ';', 
        '<', '=', '>', '?', '@', '[', '\\', ']', '^', '_', '`', '{', '|', '}', '~', ' ', "\t", "\n", "\r", "\0", "\x0B", '´', '“', '”', 
        '‘', '’', '•', '©', '®', '™', '€', '£', '¥', '₣', '₹', '₣', '₱', '₺', '₾', '₿', '°', '×', '÷', '≠', '≈', '≡', '≤', '≥', '∑', 
        '∞', '▒', '░', '▓', '▌', '▐', '▀', '▄', '▲', '▼', '◆', '∅', '©', '®', '×', '⇨', '⟶', '⊕', '⊗', '⊆', '☃', '✈', '☎', '★', 
        '☆', '✖', '✗', '✍', '⏳', '⛔'];
    }
}