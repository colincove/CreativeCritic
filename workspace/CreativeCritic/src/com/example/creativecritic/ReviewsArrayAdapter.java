package com.example.creativecritic;

import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.LinearLayout;
import android.widget.ListView;

public class ReviewsArrayAdapter extends ArrayAdapter {

	public ReviewsArrayAdapter(Context context, int resource) {
		super(context, resource);
		// TODO Auto-generated constructor stub
	}

	public ReviewsArrayAdapter(Context context, int resource,
			int textViewResourceId) {
		super(context, resource, textViewResourceId);
		// TODO Auto-generated constructor stub
	}

	public ReviewsArrayAdapter(Context context, int resource, Object[] objects) {
		super(context, resource, objects);
		// TODO Auto-generated constructor stub
	}

	public ReviewsArrayAdapter(Context context, int resource, List objects) {
		super(context, resource, objects);
		// TODO Auto-generated constructor stub
	}

	public ReviewsArrayAdapter(Context context, int resource,
			int textViewResourceId, Object[] objects) {
		super(context, resource, textViewResourceId, objects);
		// TODO Auto-generated constructor stub
	}

	public ReviewsArrayAdapter(Context context, int resource,
			int textViewResourceId, List objects) {
		super(context, resource, textViewResourceId, objects);
		// TODO Auto-generated constructor stub
	}
	@ Override
	public View getView(int position, View convertView, ViewGroup parent){
		LayoutInflater inflater = (LayoutInflater)this.getContext().getSystemService
			      (Context.LAYOUT_INFLATER_SERVICE);
		if(convertView == null){
			convertView = inflater.inflate(R.layout.review_item, parent, false);
		}
		
		return convertView;
	}
	
	

}
