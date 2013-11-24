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
		nameValuePairs.add(new BasicNameValuePair("node_id", Integer.toString(category_id)));
		nameValuePairs.add(new BasicNameValuePair("action", "get_subordinates"));
		this.url="http://www.covertstudios.ca/IAT381/mobile_services.php";
	}
	@Override
	public Result createResult(JSONObject jObj){
		JSONArray categoryList;
		try {
			categoryList = jObj.getJSONArray("data");
			List<Category> list = new ArrayList<Category>();
			JSONObject categoryData;
			for(int i=0;i<categoryList.length();i++){
				categoryData=categoryList.getJSONObject(i);
				list.add(new Category(categoryData.getString("name"), 
						categoryData.getInt("category_id"),
						categoryData.getInt("rgt"),
						categoryData.getInt("lft")));
			}
			return new SubordinatesResult(true, this, list);
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return new Result(false, this);
	}
}
