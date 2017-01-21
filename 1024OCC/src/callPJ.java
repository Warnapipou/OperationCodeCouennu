import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.HashMap;

/*
 * Interface d'appel de l'api Page Jaune 
 * */
public class callPJ {

	public static String m_applicationId  = "d140a6f6";
	public static String m_applicationKey  = "26452728b034374bccb462e880bfb0e5";
	
	public static String constructUrl(HashMap<String, String> hParam){
		
		String sUrl = "https://api.apipagesjaunes.fr/pros/find?";

		// param what
		if(hParam.containsKey("what")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "what=" + hParam.get("what");
		}
		
		// param where
		if(hParam.containsKey("where")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "where=" + hParam.get("where");
		}
		
		// param max
		if(hParam.containsKey("max")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "max=" + hParam.get("max");
		}
		
		
		// param page
		if(hParam.containsKey("page")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "page=" + hParam.get("page");
		}
		
		
		// param proximity
		if(hParam.containsKey("proximity")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "proximity=" + hParam.get("proximity");
		}
		
		// param sort
		if(hParam.containsKey("sort")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "sort=" + hParam.get("sort");
		}
		
		// param filter
		if(hParam.containsKey("filter")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "filter=" + hParam.get("filter");
		}
		
		// param return_urls
		if(hParam.containsKey("return_urls")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "return_urls=" + hParam.get("return_urls");
		}
				
		// param map_height
		if(hParam.containsKey("map_height")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "map_height=" + hParam.get("map_height");
		}
		
		// param map_height
		if(hParam.containsKey("map_width")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "map_width=" + hParam.get("map_width");
		}
		
		// param map_height
		if(hParam.containsKey("uid")){
			if(sUrl.indexOf("?") != (sUrl.length()-1)){
				sUrl += "&";
			}
			sUrl += "uid=" + hParam.get("uid");
		}

		if(sUrl.indexOf("?") != (sUrl.length()-1)){
			sUrl += "&";
		}
		sUrl += "app_id="+m_applicationId;
		
		if(sUrl.indexOf("?") != (sUrl.length()-1)){
			sUrl += "&";
		}
		sUrl += "app_key="+m_applicationKey;
		
		System.out.println(sUrl);
		return sUrl;
	}
	
	/*
	 * get json response as string from PJ API
	 * */
   public static String getUrl(String urlToRead) throws Exception {
	  StringBuilder result = new StringBuilder();
	  URL url = new URL(urlToRead);
	  HttpURLConnection conn = (HttpURLConnection) url.openConnection();
	  conn.setRequestMethod("GET");
      BufferedReader rd = new BufferedReader(new InputStreamReader(conn.getInputStream()));
      String line;
      while ((line = rd.readLine()) != null) {
         result.append(line);
      }
      rd.close();
      return result.toString();
   }
   
	/*public static void main(String[] args) throws Exception {
		
		// TEST CLASS
		
		HashMap<String, String> hTestCall = new HashMap<String,String>();
		
		hTestCall.put("what", "plombier" );
		hTestCall.put("where", "anger" );
		hTestCall.put("max", "5" );
		hTestCall.put("page", "2" );
		hTestCall.put("proximity", "true" );
		hTestCall.put("sort", "TOTAL_REVIEWS" );
		hTestCall.put("filter", "ECO" );
		hTestCall.put("return_urls", "true" );
		hTestCall.put("map_height", "350" );
		hTestCall.put("map_width", "350" );
		hTestCall.put("uid", "testWebuser" );
		

		System.out.print(getUrl(constructUrl(hTestCall)));
	}*/
}
