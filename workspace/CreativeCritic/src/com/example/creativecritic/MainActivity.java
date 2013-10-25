package com.example.creativecritic;

import com.example.creativecritic.webservices.IResultListener;
import com.example.creativecritic.webservices.Request;
import com.example.creativecritic.webservices.Result;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;
import android.view.ViewGroup.LayoutParams;
import android.widget.Button;
import android.widget.LinearLayout;

public class MainActivity extends Activity implements IResultListener {
	private CreateCriticWebservices webservices;
	private Request userLoginRequest;
	private Request getSubordinatedRequest;
	private SubordinatesResult subordinatesResult;
	private LinearLayout listLayout;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		webservices = CreateCriticWebservices.getInstance();
		userLoginRequest=webservices.requestUserFromEmail(this);
		getSubordinatedRequest=webservices.requestSubordinates(this, 2);
		
		listLayout=(LinearLayout)findViewById(R.id.list_layout);
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
		if(result.getRequest()==getSubordinatedRequest){
			handleListResult((SubordinatesResult)result);
		}
	}

	@Override
	public void resultFail() {
		// TODO Auto-generated method stub
		
	}
	private void handleListResult(SubordinatesResult result){
		subordinatesResult=result;
		for(Category category : result.getList()){
			Button btn = new Button(this);
			
			btn.setLayoutParams(new  LinearLayout.LayoutParams(LayoutParams.MATCH_PARENT,LayoutParams.WRAP_CONTENT));
			
			btn.setText(category.getName());
			
			//listLayout.addView(btn, new  LinearLayout.LayoutParams(LayoutParams.MATCH_PARENT,LayoutParams.WRAP_CONTENT));
		}
	}

}
