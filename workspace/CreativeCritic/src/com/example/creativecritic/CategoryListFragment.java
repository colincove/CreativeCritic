package com.example.creativecritic;

import com.example.creativecritic.LowestDetailLevel.RetainedFragment;



import android.os.Bundle;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.ListFragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;

public class CategoryListFragment extends ListFragment {
	private CategoryScreen myActivity;
	private ListView listView;
	public CategoryListFragment() {
		// TODO Auto-generated constructor stub
	}
	 RetainedFragment mWorkFragment;

     @Override
     public View onCreateView(LayoutInflater inflater, ViewGroup container,
             Bundle savedInstanceState) {
        // View v = inflater.inflate(R.layout.reviews_list_fragment, container, false);
    	 
      
         return super.onCreateView(inflater, container, savedInstanceState);
     }

     @Override
     public void onActivityCreated(Bundle savedInstanceState) {
         super.onActivityCreated(savedInstanceState);
         
         FragmentManager fm = getActivity().getSupportFragmentManager();

         myActivity = (CategoryScreen)getActivity();
         listView= getListView();
         
         listView.setAdapter(myActivity.getListAdapter());
        

     }
}
