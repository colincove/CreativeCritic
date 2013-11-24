package com.example.creativecritic;

import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;
import com.example.creativecritic.webservices.CategoryReview;

@SuppressWarnings("hiding")
public class ReviewArrayAdapter<CategoryReview> extends ArrayAdapter<CategoryReview> {

	public ReviewArrayAdapter(Context context, int resource) {
		super(context, resource);
		// TODO Auto-generated constructor stub
	}

	public ReviewArrayAdapter(Context context, int resource,
			int textViewResourceId) {
		super(context, resource, textViewResourceId);
		// TODO Auto-generated constructor stub
	}


	public ReviewArrayAdapter(Context context, int resource, List<CategoryReview> objects) {
		super(context, resource, objects);
		// TODO Auto-generated constructor stub
	}

	public ReviewArrayAdapter(Context context, int resource,
			int textViewResourceId, List<CategoryReview> objects) {
		super(context, resource, textViewResourceId, objects);
		// TODO Auto-generated constructor stub
	}
	public View getView(int position, View convertView, ViewGroup parent){
		if(convertView==null){
			convertView = LayoutInflater.from(getContext()).inflate(R.layout.review_item, null);
		}
		
		TextView scoreView= (TextView) convertView.findViewById(R.id.score); 
		TextView bodyText = (TextView) convertView.findViewById(R.id.body_text);
		View bg = convertView.findViewById(R.id.item_background);
		com.example.creativecritic.webservices.CategoryReview item = (com.example.creativecritic.webservices.CategoryReview) this.getItem(position);
		
		if(position%2==0){
			bg.setBackgroundResource(R.color.even_background);
		}else{
			bg.setBackgroundResource(R.color.odd_background);
		}
		
		bodyText.setText(item.getReviewText());
		scoreView.setText(Integer.toString(item.getScore()));
		
		
		return convertView;
	}

}
