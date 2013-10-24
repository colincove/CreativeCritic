package com.example.creativecritic;

import com.example.creativecritic.webservices.IResultListener;
import com.example.creativecritic.webservices.Result;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;

public class MainActivity extends Activity implements IResultListener {
	private CreateCriticWebservices webservices;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		webservices = CreateCriticWebservices.getInstance();
		webservices.requestUserFromEmail(this);
		
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}

	@Override
	public void result(Result result) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void resultFail() {
		// TODO Auto-generated method stub
		
	}

}
