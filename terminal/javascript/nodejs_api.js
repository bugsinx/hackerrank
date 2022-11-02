const request = require('request');

async function getMovieList(year) {
    // write your code here
    // API endpoint: https://jsonmock.hackerrank.com/api/movies?Year=<year>
    
    let api_url = "https://jsonmock.hackerrank.com/api/movies?Year=" + year;        
    
    return new Promise((resolve,reject) => {
       request(api_url,function(error, response, body) {
           if(error) {
               reject(error);
           }
           else {
               const json_body = JSON.parse(body);
               let movies_array = [];
                              
               for(var movie in json_body.data){
                   movies_array[movie] = json_body.data[movie].Title;
               }
               
               resolve(movies_array);
           }
       });
    });
