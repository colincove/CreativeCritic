package com.example.creativecritic.webservices;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.UUID;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONException;
import org.json.JSONObject;

import android.util.Log;

public abstract class Webservices {
	
	protected Webservices(){
		
	}
	public void request(Request request){
		Thread requestThread  = new RequestThread(request);
		requestThread.start();
	}
}
class RequestThread extends Thread{
	private Request request;
	public RequestThread(Request request){
		super("Webservice Thread");
		this.request=request;
}
	@Override
	public void run(){
		// Create a new HttpClient and Post Header
	    HttpClient httpclient = new DefaultHttpClient();
	    HttpPost httppost = new HttpPost(request.getUrl());
	    InputStream is = null;
	    JSONObject jObj = null;
	    String json = "";
	    try {

	        httppost.setEntity(new UrlEncodedFormEntity(request.getNameValuePairs()));

	        // Execute HTTP Post Request
	        HttpResponse response = httpclient.execute(httppost);
	        HttpEntity httpEntity = response.getEntity();
	        is = httpEntity.getContent();
	        
	        

	    } catch (ClientProtocolException e) {
	        // TODO Auto-generated catch block
	    } catch (IOException e) {
	        // TODO Auto-generated catch block
	    }
	    try {
            BufferedReader reader = new BufferedReader(new InputStreamReader(
                    is, "iso-8859-1"), 8);
            StringBuilder sb = new StringBuilder();
            String line = null;
            while ((line = reader.readLine()) != null) {
                sb.append(line + "\n");
            }
            is.close();
            json = sb.toString();
        } catch (Exception e) {
            Log.e("Buffer Error", "Error converting result " + e.toString());
        }

        // try parse the string to a JSON object
        try {
            jObj = new JSONObject(json);
        } catch (JSONException e) {
            Log.e("JSON Parser", "Error parsing data " + e.toString());
        }
	    Result result=request.createResult(jObj);
        
        request.getResultListener().result(result);
	}
}
