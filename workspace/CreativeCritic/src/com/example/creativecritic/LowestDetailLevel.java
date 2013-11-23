package com.example.creativecritic;

import java.util.ArrayList;
import java.util.List;

import com.example.creativecritic.webservices.CategoryReview;
import com.example.creativecritic.webservices.GetReviewsRequest;
import com.example.creativecritic.webservices.GetReviewsResult;
import com.example.creativecritic.webservices.IResultListener;
import com.example.creativecritic.webservices.Request;
import com.example.creativecritic.webservices.Result;

import android.annotation.TargetApi;
import android.app.ActionBar;
import android.app.Activity;
import android.os.Bundle;
import android.content.Context;
import android.content.Intent;
import android.os.Build;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentTransaction;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;

public class LowestDetailLevel extends FragmentActivity implements
		ActionBar.OnNavigationListener, OnClickListener, IResultListener {


	private TextView titleText;
	private TextView scoreText;
	private EditText scoreComment;
	private Button postScoreButton;
	private ListView otherUserListView;
	private GetReviewsResult getReviewsResult;
	private Request getReviewsRequest;
	private RetainedFragment workerFragment;
	
	private ArrayAdapter<CategoryReview> listAdapter;
	private List<CategoryReview> category_list;
	
	private CreateCriticWebservices webservices;

	/**
	 * The serialization (saved instance state) Bundle key representing the
	 * current dropdown position.
	 */
	private static final String STATE_SELECTED_NAVIGATION_ITEM = "selected_navigation_item";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_lowest_detail_level);

		Fragment oldFragmentTag = getSupportFragmentManager().findFragmentByTag("REVIEWTAG");
		Fragment oldFragmentId = getSupportFragmentManager().findFragmentById(R.id.review_state_fragment);
		
		// First time init, create the UI.
		
        if (savedInstanceState == null) {
            getSupportFragmentManager().beginTransaction().add(android.R.id.content,
                    new ReviewListFragment()).commit();
            
            FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
            Fragment  fragment  = new RetainedFragment();
            fragmentTransaction.add(fragment, "REVIEWTAG");
            fragmentTransaction.commit();
        }
		

		// Set up the action bar to show a dropdown list.
		final ActionBar actionBar = getActionBar();
		actionBar.setDisplayShowTitleEnabled(false);
		actionBar.setNavigationMode(ActionBar.NAVIGATION_MODE_LIST);

		// Set up the dropdown list navigation in the action bar.
		actionBar.setListNavigationCallbacks(
		// Specify a SpinnerAdapter to populate the dropdown list.
				new ArrayAdapter<String>(getActionBarThemedContextCompat(),
						android.R.layout.simple_list_item_1,
						android.R.id.text1, new String[] {
								getString(R.string.title_section1),
								getString(R.string.title_section2),
								getString(R.string.title_section3), }), this);
		
		titleText = (TextView) findViewById(R.id.inDepthTitleTextView);
		
		scoreText = (TextView) findViewById(R.id.inDepthScoreNumberTextView);
		
		scoreComment = (EditText) findViewById(R.id.userCommentsTextView);
		
		postScoreButton = (Button) findViewById(R.id.newScoreButton);
		postScoreButton.setOnClickListener(this);
		
		/*otherUserListView = (ListView) findViewById(R.id.discussionPostsTextView);
		if(getReviewsResult==null){
			webservices = CreateCriticWebservices.getInstance();
			//getReviewsRequest=webservices.getReviews(this, 8);
			category_list =   new ArrayList<CategoryReview>();
		}
		
		//listAdapter = new ReviewsArrayAdapter(this, R.layout.review_item2, category_list);
		listAdapter = new ArrayAdapter<CategoryReview>(this, R.layout.review_item2, category_list);

		
		otherUserListView.setAdapter(listAdapter);*/
	}

	/**
	 * Backward-compatible version of {@link ActionBar#getThemedContext()} that
	 * simply returns the {@link android.app.Activity} if
	 * <code>getThemedContext</code> is unavailable.
	 */
	@TargetApi(Build.VERSION_CODES.ICE_CREAM_SANDWICH)
	private Context getActionBarThemedContextCompat() {
		if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.ICE_CREAM_SANDWICH) {
			return getActionBar().getThemedContext();
		} else {
			return this;
		}
	}

	@Override
	public void onRestoreInstanceState(Bundle savedInstanceState) {
		// Restore the previously serialized current dropdown position.
		if (savedInstanceState.containsKey(STATE_SELECTED_NAVIGATION_ITEM)) {
			getActionBar().setSelectedNavigationItem(
					savedInstanceState.getInt(STATE_SELECTED_NAVIGATION_ITEM));
		}
		
	}

	@Override
	public void onSaveInstanceState(Bundle outState) {
		// Serialize the current dropdown position.
		outState.putInt(STATE_SELECTED_NAVIGATION_ITEM, getActionBar()
				.getSelectedNavigationIndex());
		super.onSaveInstanceState(outState);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.lowest_detail_level, menu);
		return true;
	}

	@Override
	public boolean onNavigationItemSelected(int position, long id) {
		// When the given dropdown item is selected, show its contents in the
		// container view.
		Fragment fragment = new DummySectionFragment();
		Bundle args = new Bundle();
		args.putInt(DummySectionFragment.ARG_SECTION_NUMBER, position + 1);
		fragment.setArguments(args);
		getSupportFragmentManager().beginTransaction()
				.replace(R.id.container, fragment).commit();
		return true;
	}

	/**
	 * A dummy fragment representing a section of the app, but that simply
	 * displays dummy text.
	 */
	public static class DummySectionFragment extends Fragment {
		/**
		 * The fragment argument representing the section number for this
		 * fragment.
		 */
		public static final String ARG_SECTION_NUMBER = "section_number";

		public DummySectionFragment() {
		}

		@Override
		public View onCreateView(LayoutInflater inflater, ViewGroup container,
				Bundle savedInstanceState) {
			View rootView = inflater.inflate(
					R.layout.fragment_lowest_detail_level_dummy, container,
					false);
			TextView dummyTextView = (TextView) rootView
					.findViewById(R.id.section_label);
			dummyTextView.setText(Integer.toString(getArguments().getInt(
					ARG_SECTION_NUMBER)));
			return rootView;
		}
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		if(v.getId() == R.id.newScoreButton)
		{
			Intent i = new Intent(this, ScoreCreate.class);
			startActivity(i);
		}
	}

	@Override
	public void result(Result result) {
		// TODO Auto-generated method stub
		GetReviewsResult getReviewsResult = (GetReviewsResult) result;
		listAdapter.clear();
		listAdapter.addAll(getReviewsResult.getReviews());
	}

	@Override
	public void resultFail() {
		// TODO Auto-generated method stub
		
	}
	 public static class RetainedFragment extends Fragment {
		 private static final String TAG = "REVIEWTAG";
		 	private boolean hasCommunicated;
	        /**
	         * Fragment initialization.  We way we want to be retained and
	         * start our thread.
	         */
		 	public boolean communicate(){
		 	return hasCommunicated;
		 	}
		 	
	        @Override
	        public void onCreate(Bundle savedInstanceState) {
	            super.onCreate(savedInstanceState);
	            
	            // Tell the framework to try to keep this fragment around
	            // during a configuration change.
	            setRetainInstance(true);
	         
	        }

	        /**
	         * This is called when the Fragment's Activity is ready to go, after
	         * its content view has been installed; it is called both after
	         * the initial fragment creation and after the fragment is re-attached
	         * to a new activity.
	         */
	        @Override
	        public void onActivityCreated(Bundle savedInstanceState) {
	            super.onActivityCreated(savedInstanceState);
	            setRetainInstance(true);
	            
	        }

	        /**
	         * This is called when the fragment is going away.  It is NOT called
	         * when the fragment is being propagated between activity instances.
	         */
	        @Override
	        public void onDestroy() {
	            
	            
	            super.onDestroy();
	        }

	        /**
	         * This is called right before the fragment is detached from its
	         * current activity instance.
	         */
	        @Override
	        public void onDetach() {
	            // This fragment is being detached from its activity.  We need
	            // to make sure its thread is not going to touch any activity
	            // state after returning from this function.
	          
	            
	            super.onDetach();
	        }
	        @Override
	        public void onAttach(Activity activity){
	        	super.onAttach(activity);
	        }
	        /**
	         * API for our UI to restart the progress thread.
	         */
	        public void restart() {
	           
	        }
	       
	        
	 }
}
