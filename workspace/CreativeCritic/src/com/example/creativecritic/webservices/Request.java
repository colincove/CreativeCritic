package com.example.creativecritic.webservices;

import java.util.ArrayList;
import java.util.List;
import java.util.UUID;

import org.apache.http.NameValuePair;
import org.json.JSONObject;

public class Request {
	private UUID uuid;
	protected List<NameValuePair> nameValuePairs;
	protected String url;
	private IResultListener resultListener;
	public Request(IResultListener resultListener){
		this.resultListener = resultListener;
		url="";
		nameValuePairs=new ArrayList<NameValuePair>();
		uuid = new UUID(8, 4);
	}
	public UUID getUUId(){
		return uuid;
	}
	public List<NameValuePair> getNameValuePairs(){
		return nameValuePairs;
	}
	public String getUrl(){
		return url;
	}
	public void setUrl(String value){
		url=value;
	}
	public IResultListener getResultListener(){
		return resultListener;
	}
	public Result createResult(JSONObject jObj){
		return new Result(true, this);
	}
}
