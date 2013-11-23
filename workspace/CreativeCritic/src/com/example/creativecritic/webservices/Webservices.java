package com.example.creativecritic.webservices;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
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

import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.os.Message;
import android.util.Log;

public abstract class Webservices {
	
	protected Webservices() {
	}
	
	public Request request(Request request) {
		Thread requestThread = new RequestThread(request, new MessageHandler(request.getLooper(), request));
		requestThread.start();
		return request;
	}

	public void handleResponse(HttpResponse response, Request request) {
		InputStream is = null;
		JSONObject jObj = null;
		String json = "";
		try {
			HttpEntity httpEntity = response.getEntity();
			is = httpEntity.getContent();

			BufferedReader reader = new BufferedReader(new InputStreamReader(
					is, "iso-8859-1"), 8);
			StringBuilder sb = new StringBuilder();
			String line = null;
			while ((line = reader.readLine()) != null) {
				sb.append(line + "\n");
			}
			is.close();
			json = sb.toString();
			jObj = new JSONObject(json);
		} catch (Exception e) {
			Log.e("Buffer Error", "Error converting result " + e.toString());
		}
		Result result = request.createResult(jObj);
		request.getResultListener().result(result);
	}
}
class MessageHandler extends Handler{
	private Request request;
	public MessageHandler(Looper looper,Request request){
		super(looper);
		this.request=request;
	}
	@ Override
	public void handleMessage(Message inputMessage){
		JSONObject jObj = null;
		try {
			jObj = new JSONObject(inputMessage.getData().getString("JSON"));
		} catch (Exception e) {
			Log.e("Buffer Error", "Error converting result " + e.toString());
		}
		Result result = request.createResult(jObj);
		request.getResultListener().result(result);
	}
}
class RequestThread extends Thread {
	
	private Request request;
	private Handler handler;

	public RequestThread(Request request, Handler handler) {
		super("Webservice Thread");
		this.request = request;
		this.handler=handler;
	}
	@Override
	public void run() {
		String json = "";
		InputStream is = null;
		// Create a new HttpClient and Post Header
		HttpClient httpclient = new DefaultHttpClient();
		HttpPost httppost = new HttpPost(request.getUrl());
		try {
			httppost.setEntity(new UrlEncodedFormEntity(request
					.getNameValuePairs()));
			// Execute HTTP Post Request
			HttpResponse response;
			response = httpclient.execute(httppost);
			HttpEntity httpEntity = response.getEntity();
			is = httpEntity.getContent();

			BufferedReader reader = new BufferedReader(new InputStreamReader(
					is, "iso-8859-1"), 8);
			StringBuilder sb = new StringBuilder();
			String line = null;
			while ((line = reader.readLine()) != null) {
				sb.append(line + "\n");
			}
			is.close();
			json = sb.toString();
			Message msg = new Message();
			Bundle bundle = new Bundle();
			bundle.putString("JSON", json);
			msg.setData(bundle);
			handler.sendMessage(msg);
		} catch (UnsupportedEncodingException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (ClientProtocolException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}
