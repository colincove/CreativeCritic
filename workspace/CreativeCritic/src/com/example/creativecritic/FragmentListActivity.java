package com.example.creativecritic;

import java.util.ArrayList;
import java.util.List;

import com.example.creativecritic.webservices.IResultListener;
import com.example.creativecritic.webservices.Result;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.app.ListFragment;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;

public class FragmentListActivity<TList, TWorkerFragment> extends
		FragmentActivity implements IResultListener, OnItemClickListener {
	protected ArrayAdapter<TList> listAdapter;
	protected TWorkerFragment workerFragment;
	public static final String WORKER_TAG = "worker_fragment";

	private Generic generic;
	protected ListFragment listFragment;
	protected CreateCriticWebservices webservices;
	protected List<TList> category_list;

	public FragmentListActivity(Generic generic) {
		this.generic = generic;
	}

	public ArrayAdapter<TList> getListAdapter() {
		return listAdapter;
	}

	@Override
	protected void onCreate(Bundle savedStateInstance) {
		super.onCreate(savedStateInstance);
		workerFragment = (TWorkerFragment) getSupportFragmentManager()
				.findFragmentByTag(WORKER_TAG);
		listFragment = (ListFragment) getSupportFragmentManager()
				.findFragmentById(R.id.list_fragment);
		category_list = new ArrayList<TList>();
		// First time init, create the UI.
		try {
			
		

		if (workerFragment == null) {
			FragmentTransaction fragmentTransaction = getSupportFragmentManager()
					.beginTransaction();
				workerFragment = (TWorkerFragment) generic.buildOne();
	
			fragmentTransaction.add((Fragment) workerFragment, WORKER_TAG);
			fragmentTransaction.commit();
		}
		} catch (InstantiationException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		} catch (IllegalAccessException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		webservices = CreateCriticWebservices.getInstance();

	}

	@Override
	public void result(Result result) {
		// TODO Auto-generated method stub
		if(listFragment==null){
			
			listFragment = (ListFragment) getSupportFragmentManager()
					.findFragmentById(R.id.list_fragment);
		}
		listFragment.getListView().setOnItemClickListener(this);
	}

	@Override
	public void resultFail() {
		// TODO Auto-generated method stub

	}

	@Override
	public void onItemClick(AdapterView<?> arg0, View arg1, int arg2, long arg3) {
		// TODO Auto-generated method stub
		
	}

}
