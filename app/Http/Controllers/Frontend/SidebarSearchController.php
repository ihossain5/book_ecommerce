<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publication;
use Illuminate\Http\Request;

class SidebarSearchController extends Controller
{
    public function book_search(Request $request)
    {
        //dd($request->all());
        $key   = $request->navbar_search;
        $books = Book::with('authors')->where('title', 'like', '%' . $key . '%')
            ->orwhere('slug', 'like', '%' . $key . '%')
            ->where('is_visible', 1)->paginate(12);
        $authors      = Author::orderBy('name')->get();
        $categories   = Category::orderBy('name')->get();
        $publications = Publication::orderBy('name')->get();

        $title = 'Searched for "' . $key . '"';

        return view('frontend.book.offer_books', compact('books', 'authors', 'categories', 'publications', 'title'));
    }

    public function getBook(Request $request)
    {

        //dd($request->all());
        $search        = $request->search;
        $search_mobile = $request->search_mobile;

        if ($search == '' && $search_mobile == '') {
            $response = null;
        } else {

            if ($search != null) {
                $books = Book::with('authors')->where('title', 'like', '%' . $search . '%')
                    ->orwhere('slug', 'like', '%' . $search . '%')
                    ->where('is_visible', 1)->limit(5)->get();
            } else {
                $books = Book::with('authors')->where('title', 'like', '%' . $search_mobile . '%')
                    ->orwhere('slug', 'like', '%' . $search_mobile . '%')
                    ->where('is_visible', 1)->limit(5)->get();
            }

            $response = array();
            foreach ($books as $book) {
                $response[] = array(
                    "value"   => $book->book_id,
                    "title"   => $book->title,
                    "image"   => $book->cover_image,
                    "price"   => englishTobangla($book->discounted_price),
                    "authors" => $book->authors,
                );
            }
        }

        return response()->json([
            'success' => true,
            'value'   => $response,

        ]);
    }

    public function author_sidebar_filter(Request $request)
    {
        //dd($request->all());
        $request->writer_search_key_sidebar;

        if ($request->writer_search_key_sidebar != null) {

            $author_list = Author::where('name', 'LIKE', '%' . $request->writer_search_key_sidebar . '%')->orderBy('name')->get();

            return response()->json([
                'success'     => true,
                'author_list' => $author_list,
                'message'     => 'all author!',

            ]);
        } else {
            $author_list = Author::orderBy('name')->get();

            return response()->json([
                'success'     => true,
                'author_list' => $author_list,
                'message'     => 'all author_list!',

            ]);
        }
    }

    public function publisher_sidebar_filter(Request $request)
    {
        //dd($request->all());
        $request->publisher_search_key_sidebar;

        if ($request->publisher_search_key_sidebar != null) {

            $publication_list = Publication::where('name', 'LIKE', '%' . $request->publisher_search_key_sidebar . '%')->orderBy('name')->get();

            return response()->json([
                'success'          => true,
                'publication_list' => $publication_list,
                'message'          => 'all author!',

            ]);
        } else {
            $publication_list = Publication::orderBy('name')->get();

            return response()->json([
                'success'          => true,
                'publication_list' => $publication_list,
                'message'          => 'all author_list!',

            ]);
        }
    }

    public function category_sidebar_filter(Request $request)
    {
        //dd($request->all());
        $request->category_search_key_sidebar;

        if ($request->category_search_key_sidebar != null) {

            $category_list = Category::where('name', 'LIKE', '%' . $request->category_search_key_sidebar . '%')->orderBy('name')->get();

            return response()->json([
                'success'       => true,
                'category_list' => $category_list,
                'message'       => 'all author!',

            ]);
        } else {
            $category_list = Category::orderBy('name')->get();

            return response()->json([
                'success'       => true,
                'category_list' => $category_list,
                'message'       => 'all author_list!',

            ]);
        }
    }
}
