package com.example.creativecritic;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.example.creativecritic.webservices.IResultListener;
import com.example.creativecritic.webservices.Request;
import com.example.creativecritic.webservices.Result;

public class SubordinatesRequest extends Request {
	private int category_id;
	public SubordinatesRequest(IResultListener resultListener, int category_id) {
		super(resultListener);
		this.category_id=category_id;
		nameValuePairs.add(new BasicNameValuePair("category_id", Integer.toString(category_id)));
		nameValuePairs.add(new BasicNameValuePair("action", "get_subordinates"));
		this.url="http://www.covertstudios.ca/IAT381/mobile_services.php";
	}
	@Override
	public Result createResult(JSONObject jObj){
		JSONArray categoryList;
		JSONArray categoryPath;
		JSONObject googleImages=null;
		JSONObject googleResponseData;
		JSONArray googleResults;
		JSONObject image;
		Category selected=null;
		try {
			categoryList = jObj.getJSONArray("data");
			categoryPath = jObj.getJSONArray("path");
			
			 
			 
			List<Category> list = new ArrayList<Category>();
			List<CategoryPathNode> pathList = new ArrayList<CategoryPathNode>();
			
			
			for(int i=0;i<categoryList.length();i++){
			
				
			}
			
			JSONObject categoryData;
			
			for(int i=0;i<categoryList.length();i++){
				categoryData=categoryList.getJSONObject(i);
				List<String> google_images = new ArrayList<String>();
				try{
				googleImages  = categoryData.getJSONObject("google_images");
				
					
				
				 googleResponseData = googleImages.getJSONObject("responseData");
				 googleResults=googleResponseData.getJSONArray("results");
				 for( int j =0;j<googleResults.length();j++){
					 image = googleResults.getJSONObject(j);
					google_images.add(image.getString("url"));
				 }
				}catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				
				list.add(new Category(categoryData.getString("name"), 
						(float)categoryData.getDouble("avg_score"),
						categoryData.getInt("category_id"),
						categoryData.getInt("rgt"),
						categoryData.getInt("lft"),
						google_images));
			}
			for(Category cat :list){
				//remove item from list if it is the one we searched for. 
				if(cat.getId()==category_id){
					selected=cat;
					list.remove(cat);
					break;
				}
			}
			for(int i=0;i<categoryPath.length();i++){
				categoryData=categoryPath.getJSONObject(i);
				pathList.add(new CategoryPathNode(categoryData.getString("name"), 
						categoryData.getInt("category_id")));
			}
			return new SubordinatesResult(true,selected, this, list, pathList);
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return new Result(false, this);
	}
}
