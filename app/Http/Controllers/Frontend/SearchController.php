<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publication;
use App\Http\Controllers\Controller;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use App\Models\OfferBooks;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function popularBookFilter(Request $request)
    {
        // dd($request->all());

        $offer_id = $request->offer_id;
        $category_list = $request->category_list;
        $category_search_key = $request->category_search_key;
        $publisher_search_key = $request->publisher_search_key;
        $price = $request->price;
        $publisher_list = $request->publisher_list;
        $writer_list = $request->writer_list;
        $writer_search_key = $request->writer_search_key;

        if ($category_search_key != null || $writer_search_key != null || $publisher_search_key != null) {

            if ($writer_search_key != null) {

                $book_authors = Author::where('name', 'LIKE', '%' . $writer_search_key . '%')->get();
                //dd($book_categories);
                $author_ids = [];
                foreach ($book_authors as $book_author) {

                    $author_ids[] = $book_author->author_id;
                }
                //dd($author_ids);

                $book_authors = BookAuthor::whereIn('author_id', $author_ids)->get();

                //dd($book_authors);
                $book_ids = [];
                foreach ($book_authors as $book_authors) {

                    $book_ids[] = $book_authors->book_id;
                }
                //dd($book_ids);
                //$book_ID = [];

                if ($offer_id != null) {

                    $offer_books = OfferBooks::where('offer_id', $offer_id)->whereIn('book_id', $book_ids)->get();
                    $book_ids = [];
                    foreach ($offer_books as $offer_book) {

                        $book_ids[] = $offer_book->book_id;
                    }
                }



                if ($book_ids != null) {

                    $bookID = Book::where('is_visible', 1)->whereIn('book_id', $book_ids)->with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }

                    //dd($bookID);
                } else {
                    $bookID = [];
                }
            }

            if ($publisher_search_key != null) {

                $book_publications = Publication::where('name', 'LIKE', '%' . $publisher_search_key . '%')->get();
                //dd($book_categories);
                $publication_ids = [];
                foreach ($book_publications as $book_publication) {

                    $publication_ids[] = $book_publication->publication_id;
                }
                //dd($publication_ids);

                if ($offer_id != null) {

                    $offer_books = OfferBooks::where('offer_id', $offer_id)->whereIn('book_id', $book_ids)->get();
                    $publication_ids = [];
                    foreach ($offer_books as $offer_book) {

                        $publication_ids[] = $offer_book->book_id;
                    }
                }

                if ($publication_ids != null) {

                    $bookID = Book::where('is_visible', 1)->whereIn('publication_id', $publication_ids)->with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->get();


                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }

                    //dd($bookID);
                } else {
                    $bookID = [];
                }
            }


            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($writer_list != null) {
            $book_authors = BookAuthor::whereIn('author_id', $writer_list)->get();

            //dd($book_authors);
            $book_list = [];

            foreach ($book_authors as $book_author) {

                $book_list[] = $book_author->book_id;
            }

            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->whereIn('book_id', $book_list)->get();
                $book_list = [];
                foreach ($offer_books as $offer_book) {

                    $book_list[] = $offer_book->book_id;
                }
            }


            //dd($book_list);
            $unique = array_unique($book_list);
            //dd($unique);



            // $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $unique)->where('is_visible', 1)->get();
            $bookID = Book::where('is_visible', 1)->whereIn('book_id', $unique)->with('authors', 'publication', 'reviews', 'orders')->withCount([
                'orders as counted_order' => function ($query) {
                    $query->where('order_status_id', 3);
                }
            ])->orderBy('counted_order', 'DESC')->get();

            foreach ($bookID as $book) {
                $rating = getTotalRating($book->reviews);
                $book->rating = $rating;
            }
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($publisher_list) {

            $book_list = [];

            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->get();
                foreach ($offer_books as $offer_book) {

                    $book_list[] = $offer_book->book_id;
                }

                // $bookID = Book::with('authors', 'reviews')->whereIn('publication_id', $publisher_list)->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                $bookID = Book::where('is_visible', 1)->whereIn('publication_id', $publisher_list)->whereIn('book_id', $book_list)->with('authors', 'publication', 'reviews', 'orders')->withCount([
                    'orders as counted_order' => function ($query) {
                        $query->where('order_status_id', 3);
                    }
                ])->orderBy('counted_order', 'DESC')->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {
                // $bookID = Book::with('authors', 'reviews')->whereIn('publication_id', $publisher_list)->where('is_visible', 1)->get();
                $bookID = Book::where('is_visible', 1)->whereIn('publication_id', $publisher_list)->with('authors', 'publication', 'reviews', 'orders')->withCount([
                    'orders as counted_order' => function ($query) {
                        $query->where('order_status_id', 3);
                    }
                ])->orderBy('counted_order', 'DESC')->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            }

            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($price != null) {

            $book_list = [];

            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->get();
                foreach ($offer_books as $offer_book) {

                    $book_list[] = $offer_book->book_id;
                }

                if ($price == 100) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereBetween('discounted_price', [0, 100])->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 500) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereBetween('discounted_price', [100, 500])->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 1000) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereBetween('discounted_price', [500, 1000])->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 1500) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereBetween('discounted_price', [1000, 2000])->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 2000) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->where('discounted_price', '=>', 2000)->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } else {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                }
            } else {
                if ($price == 100) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereBetween('discounted_price', [0, 100])->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 500) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereBetween('discounted_price', [100, 500])->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 1000) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereBetween('discounted_price', [500, 1000])->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 1500) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->whereBetween('discounted_price', [1000, 2000])->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 2000) {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->where('discounted_price', '=>', 2000)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } else {
                    $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                        'orders as counted_order' => function ($query) {
                            $query->where('order_status_id', 3);
                        }
                    ])->orderBy('counted_order', 'DESC')->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                }
            }

            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($category_list != null) {

            $book_categories = BookCategory::whereIn('category_id', $category_list)->get();

            //dd($book_categories);
            $book_ids = [];
            foreach ($book_categories as $book_category) {

                $book_ids[] = $book_category->book_id;
            }
            //dd($book_ids);

            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->whereIn('book_id', $book_ids)->get();
                $book_ids = [];
                foreach ($offer_books as $offer_book) {

                    $book_ids[] = $offer_book->book_id;
                }
            }

            $bookID = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                'orders as counted_order' => function ($query) {
                    $query->where('order_status_id', 3);
                }
            ])->orderBy('counted_order', 'DESC')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();
            foreach ($bookID as $book) {
                $rating = getTotalRating($book->reviews);
                $book->rating = $rating;
            }
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } else {

            $book_ids = [];
            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->get();
                $book_ids = [];
                foreach ($offer_books as $offer_book) {

                    $book_ids[] = $offer_book->book_id;
                }

                $books = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                    'orders as counted_order' => function ($query) {
                        $query->where('order_status_id', 3);
                    }
                ])->orderBy('counted_order', 'DESC')->where('is_visible', 1)->whereIn('book_id', $book_ids)->get();
                foreach ($books as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {

                $books = Book::with('authors', 'publication', 'reviews', 'orders')->withCount([
                    'orders as counted_order' => function ($query) {
                        $query->where('order_status_id', 3);
                    }
                ])->orderBy('counted_order', 'DESC')->where('is_visible', 1)->get();
                foreach ($books as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            }


            return response()->json([
                'success' => true,
                'book_list' => $books,
            ]);
        }
    }

    public function book_filter(Request $request)
    {
        //dd($request->all());

        $offer_id = $request->offer_id;
        $category_list = $request->category_list;
        $category_search_key = $request->category_search_key;
        $publisher_search_key = $request->publisher_search_key;
        $price = $request->price;
        $publisher_list = $request->publisher_list;
        $writer_list = $request->writer_list;
        $writer_search_key = $request->writer_search_key;

        //dd($category_search_key);

        if ($category_search_key != null || $writer_search_key != null || $publisher_search_key != null) {

            if ($writer_search_key != null) {

                $book_authors = Author::where('name', 'LIKE', '%' . $writer_search_key . '%')->get();
                //dd($book_categories);
                $author_ids = [];
                foreach ($book_authors as $book_author) {

                    $author_ids[] = $book_author->author_id;
                }
                //dd($author_ids);

                $book_authors = BookAuthor::whereIn('author_id', $author_ids)->get();

                //dd($book_authors);
                $book_ids = [];
                foreach ($book_authors as $book_authors) {

                    $book_ids[] = $book_authors->book_id;
                }
                //dd($book_ids);
                //$book_ID = [];

                if ($offer_id != null) {

                    $offer_books = OfferBooks::where('offer_id', $offer_id)->whereIn('book_id', $book_ids)->get();
                    $book_ids = [];
                    foreach ($offer_books as $offer_book) {

                        $book_ids[] = $offer_book->book_id;
                    }
                }



                if ($book_ids != null) {

                    $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }

                    //dd($bookID);
                } else {
                    $bookID = [];
                }
            }

            if ($publisher_search_key != null) {

                $book_publications = Publication::where('name', 'LIKE', '%' . $publisher_search_key . '%')->get();
                //dd($book_categories);
                $publication_ids = [];
                foreach ($book_publications as $book_publication) {

                    $publication_ids[] = $book_publication->publication_id;
                }
                //dd($publication_ids);

                if ($offer_id != null) {

                    $offer_books = OfferBooks::where('offer_id', $offer_id)->whereIn('book_id', $book_ids)->get();
                    $publication_ids = [];
                    foreach ($offer_books as $offer_book) {

                        $publication_ids[] = $offer_book->book_id;
                    }
                }

                if ($publication_ids != null) {

                    $bookID = Book::with('authors', 'reviews')->whereIn('publication_id', $publication_ids)->where('is_visible', 1)->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }

                    //dd($bookID);
                } else {
                    $bookID = [];
                }
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($writer_list != null) {
            $book_authors = BookAuthor::whereIn('author_id', $writer_list)->get();

            //dd($book_authors);
            $book_list = [];

            foreach ($book_authors as $book_author) {

                $book_list[] = $book_author->book_id;
            }

            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->whereIn('book_id', $book_list)->get();
                $book_list = [];
                foreach ($offer_books as $offer_book) {

                    $book_list[] = $offer_book->book_id;
                }
            }


            //dd($book_list);
            $unique = array_unique($book_list);
            //dd($unique);



            $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $unique)->where('is_visible', 1)->get();

            foreach ($bookID as $book) {
                $rating = getTotalRating($book->reviews);
                $book->rating = $rating;
            }
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($publisher_list) {

            $book_list = [];

            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->get();
                foreach ($offer_books as $offer_book) {

                    $book_list[] = $offer_book->book_id;
                }

                $bookID = Book::with('authors', 'reviews')->whereIn('publication_id', $publisher_list)->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {
                $bookID = Book::with('authors', 'reviews')->whereIn('publication_id', $publisher_list)->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            }



            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($price != null) {

            $book_list = [];

            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->get();
                foreach ($offer_books as $offer_book) {

                    $book_list[] = $offer_book->book_id;
                }

                if ($price == 100) {
                    $bookID = Book::with('authors', 'reviews')->whereBetween('discounted_price', [0, 100])->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 500) {
                    $bookID = Book::with('authors', 'reviews')->whereBetween('discounted_price', [100, 500])->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 1000) {
                    $bookID = Book::with('authors', 'reviews')->whereBetween('discounted_price', [500, 1000])->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 1500) {
                    $bookID = Book::with('authors', 'reviews')->whereBetween('discounted_price', [1000, 2000])->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 2000) {
                    $bookID = Book::with('authors', 'reviews')->where('discounted_price', '=>', 2000)->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } else {
                    $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                }
            } else {
                if ($price == 100) {
                    $bookID = Book::with('authors', 'reviews')->whereBetween('discounted_price', [0, 100])->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 500) {
                    $bookID = Book::with('authors', 'reviews')->whereBetween('discounted_price', [100, 500])->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 1000) {
                    $bookID = Book::with('authors', 'reviews')->whereBetween('discounted_price', [500, 1000])->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 1500) {
                    $bookID = Book::with('authors', 'reviews')->whereBetween('discounted_price', [1000, 2000])->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } elseif ($price == 2000) {
                    $bookID = Book::with('authors', 'reviews')->where('discounted_price', '=>', 2000)->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } else {
                    $bookID = Book::with('authors', 'reviews')->where('is_visible', 1)->get();
                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                }
            }

            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($category_list != null) {

            $book_categories = BookCategory::whereIn('category_id', $category_list)->get();

            //dd($book_categories);
            $book_ids = [];
            foreach ($book_categories as $book_category) {

                $book_ids[] = $book_category->book_id;
            }
            //dd($book_ids);

            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->whereIn('book_id', $book_ids)->get();
                $book_ids = [];
                foreach ($offer_books as $offer_book) {

                    $book_ids[] = $offer_book->book_id;
                }
            }

            $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();
            foreach ($bookID as $book) {
                $rating = getTotalRating($book->reviews);
                $book->rating = $rating;
            }
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } else {

            $book_ids = [];
            if ($offer_id != null) {

                $offer_books = OfferBooks::where('offer_id', $offer_id)->get();
                $book_ids = [];
                foreach ($offer_books as $offer_book) {

                    $book_ids[] = $offer_book->book_id;
                }

                $books = Book::with('authors', 'reviews')->where('is_visible', 1)->whereIn('book_id', $book_ids)->get();
                foreach ($books as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {

                $books = Book::with('authors', 'reviews')->where('is_visible', 1)->get();
                foreach ($books as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            }


            return response()->json([
                'success' => true,
                'book_list' => $books,
            ]);
        }
    }

    public function book_detials_filter(Request $request)
    {
        //dd($request->all());

        $author_id = $request->author_id;
        $category_list = $request->category_list;
        $category_search_key = $request->category_search_key;
        $writer_search_key = $request->writer_search_key;
        $publisher_search_key = $request->publisher_search_key;
        $price = $request->price;
        $publisher_list = $request->publisher_list;
        $writer_list = $request->writer_list;

        $author_info = Author::where('author_id', $author_id)->first();
        $author_name = $author_info->name;

        if ($category_search_key != null || $writer_search_key != null || $publisher_search_key != null) {


            if ($category_search_key != null) {

                $book_categories = Category::where('name', 'LIKE', '%' . $category_search_key . '%')->get();
                //dd($book_categories);
                $category_ids = [];
                foreach ($book_categories as $book_category) {

                    $category_ids[] = $book_category->category_id;
                }
                //dd($category_ids);

                $book_categories = BookCategory::whereIn('category_id', $category_ids)->get();

                //dd($book_categories);
                $book_ids = [];
                foreach ($book_categories as $book_category) {

                    $book_ids[] = $book_category->book_id;
                }
                //dd($book_ids);

                if ($book_ids != null) {

                    $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }

                    //dd($bookID);
                } else {
                    $bookID = [];
                }
            }



            if ($writer_search_key != null) {

                $book_authors = Author::where('name', 'LIKE', '%' . $writer_search_key . '%')->get();
                //dd($book_categories);
                $author_ids = [];
                foreach ($book_authors as $book_author) {

                    $author_ids[] = $book_author->author_id;
                }
                //dd($author_ids);

                $book_authors = BookAuthor::whereIn('author_id', $author_ids)->get();

                //dd($book_authors);
                $book_ids = [];
                foreach ($book_authors as $book_authors) {

                    $book_ids[] = $book_authors->book_id;
                }
                //dd($book_ids);

                if ($book_ids != null) {

                    $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }

                    //dd($bookID);
                } else {
                    $bookID = [];
                }
            }

            if ($publisher_search_key != null) {

                $book_publications = Publication::where('name', 'LIKE', '%' . $publisher_search_key . '%')->get();
                //dd($book_categories);
                $publication_ids = [];
                foreach ($book_publications as $book_publication) {

                    $publication_ids[] = $book_publication->publication_id;
                }
                //dd($publication_ids);

                if ($publication_ids != null) {

                    $bookID = Book::with('authors', 'reviews')->whereIn('publication_id', $publication_ids)->where('is_visible', 1)->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }

                    //dd($bookID);
                } else {
                    $bookID = [];
                }
            }


            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name' => $author_name,
            ]);
        } elseif ($category_list != null) {
            //dd($category_list);

            $book_categories = BookCategory::whereIn('category_id', $category_list)->get();

            //dd($book_categories);
            $book_ids = [];
            foreach ($book_categories as $book_category) {

                $book_ids[] = $book_category->book_id;
            }
            //dd($book_ids);

            if ($book_ids != null) {

                $book_authors = BookAuthor::whereIn('book_id', $book_ids)->where('author_id', $author_id)->get();
                //dd($book_authors);

                foreach ($book_authors as $book_author) {

                    $book_list[] = $book_author->book_id;
                }
                //dd($book_list);

                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->where('is_visible', 1)->get();

                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }

                //dd($bookID);

            } else {
                $bookID = [];
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name' => $author_name,
            ]);
        } elseif ($price != null) {

            $book_authors = BookAuthor::where('author_id', $author_id)->get();

            foreach ($book_authors as $book_author) {

                $book_list[] = $book_author->book_id;
            }

            if ($price == 100) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereBetween('discounted_price', [0, 100])->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } elseif ($price == 500) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereBetween('discounted_price', [100, 500])->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } elseif ($price == 1000) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereBetween('discounted_price', [500, 1000])->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } elseif ($price == 1500) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereBetween('discounted_price', [1000, 2000])->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } elseif ($price == 2000) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->where('discounted_price', '=>', 2000)->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {

                $book_authors = BookAuthor::where('author_id', $author_id)->get();

                foreach ($book_authors as $book_author) {

                    $book_list[] = $book_author->book_id;
                }

                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->where('is_visible', 1)->get();

                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            }

            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name' => $author_name,
            ]);
        } elseif ($publisher_list != null) {

            $book_authors = BookAuthor::where('author_id', $author_id)->get();
            //dd($book_authors);

            foreach ($book_authors as $book_author) {

                $book_list[] = $book_author->book_id;
            }
            //dd($book_list);

            $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereIn('publication_id', $publisher_list)->where('is_visible', 1)->get();

            foreach ($bookID as $book) {
                $rating = getTotalRating($book->reviews);
                $book->rating = $rating;
            }

            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name' => $author_name,
            ]);
        } elseif ($writer_list != null) {

            $book_authors = BookAuthor::whereIn('author_id', $writer_list)->get();

            //dd($book_authors);
            $book_list = [];

            foreach ($book_authors as $book_author) {

                $book_list[] = $book_author->book_id;
            }
            //dd($book_list);
            $unique = array_unique($book_list);
            //dd($unique);

            $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $unique)->where('is_visible', 1)->get();

            foreach ($bookID as $book) {
                $rating = getTotalRating($book->reviews);
                $book->rating = $rating;
            }
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name' => $author_name,
            ]);
        } else {
            $book_authors = BookAuthor::where('author_id', $author_id)->get();

            foreach ($book_authors as $book_author) {

                $book_list[] = $book_author->book_id;
            }

            $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->where('is_visible', 1)->get();

            foreach ($bookID as $book) {
                $rating = getTotalRating($book->reviews);
                $book->rating = $rating;
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name' => $author_name,
            ]);
        }
    }




    public function topic_filter(Request $request)
    {
        //dd($request->all());

        $category_id = $request->category_id;
        $category_list = $request->category_list;
        $category_search_key = $request->category_search_key;
        $writer_search_key = $request->writer_search_key;
        $publisher_search_key = $request->publisher_search_key;
        $price = $request->price;
        $publisher_list = $request->publisher_list;
        $writer_list = $request->writer_list;

        if ($category_search_key != null || $writer_search_key != null || $publisher_search_key != null) {


            if ($category_search_key != null) {

                $categories = Category::where('name', 'LIKE', '%' . $category_search_key . '%')->get();
                //dd($categories);;
                $category_ids = [];
                foreach ($categories as $category) {

                    $category_ids[] = $category->category_id;
                }
                //dd($book_ids);

                $category_books = BookCategory::whereIn('category_id', $category_ids)->get();
                //dd($category_books);

                $book_ids = [];
                foreach ($category_books as $category_book) {

                    $book_ids[] = $category_book->book_id;
                }

                //dd($book_ids);

                if ($book_ids != null) {

                    $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } else {
                    $bookID = [];
                }
            }
            if ($writer_search_key != null) {

                $category_id = $request->category_id;

                $authors = Author::where('name', 'LIKE', '%' . $writer_search_key . '%')->get();
                //dd($book_categories);
                $author_ids = [];
                foreach ($authors as $author) {

                    $author_ids[] = $author->author_id;
                }
                //dd($author_ids);

                $books_id = BookAuthor::whereIn('author_id', $author_ids)->get();

                $author_books_ids = [];
                foreach ($books_id as $book_id) {

                    $author_books_ids[] = $book_id->book_id;
                }
                //dd($author_books_ids);

                $book_categories = BookCategory::whereIn('book_id', $author_books_ids)->where('category_id', $category_id)->get();

                //dd($book_authors);
                $book_ids = [];
                foreach ($book_categories as $book_category) {

                    $book_ids[] = $book_category->book_id;
                }
                //dd($book_ids);

                if ($book_ids != null) {

                    $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } else {
                    $bookID = [];
                }
            }
            if ($publisher_search_key != null) {

                $category_id = $request->category_id;

                $book_publications = Publication::where('name', 'LIKE', '%' . $publisher_search_key . '%')->get();
                //dd($book_publications);
                $publication_ids = [];
                foreach ($book_publications as $book_publication) {

                    $publication_ids[] = $book_publication->publication_id;
                }
                //dd($publication_ids);


                $publicationToBooks = Book::whereIn('publication_id', $publication_ids)->get();
                //dd($publicationToBooks);
                $Book_Category_ids = [];
                foreach ($publicationToBooks as $publicationToBook) {

                    $Book_Category_ids[] = $publicationToBook->book_id;
                }
                //dd($Book_Category_ids);
                $book_categories = BookCategory::whereIn('book_id', $Book_Category_ids)->where('category_id', $category_id)->get();

                //dd($book_categories);
                $book_ids = [];
                foreach ($book_categories as $book_category) {

                    $book_ids[] = $book_category->book_id;
                }

                if ($book_ids != null) {

                    $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();

                    foreach ($bookID as $book) {
                        $rating = getTotalRating($book->reviews);
                        $book->rating = $rating;
                    }
                } else {
                    $bookID = [];
                    $author_name = "";
                }
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,

            ]);
        } elseif ($writer_list != null) {

            $category_id = $request->category_id;
            $book_authors = BookAuthor::whereIn('author_id', $writer_list)->get();

            //dd($book_authors);
            $book_list = [];

            foreach ($book_authors as $book_author) {

                $book_list[] = $book_author->book_id;
            }
            //dd($book_list);
            $unique = array_unique($book_list);
            //dd($unique);

            $book_categories = BookCategory::whereIn('book_id', $unique)->where('category_id', $category_id)->get();

            //dd($book_authors);
            $book_ids = [];
            foreach ($book_categories as $book_category) {

                $book_ids[] = $book_category->book_id;
            }
            //dd($book_ids);

            if ($book_ids != null) {

                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_ids)->where('is_visible', 1)->get();

                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {
                $bookID = [];
                $author_name = "";
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($publisher_list != null) {

            $category_id = $request->category_id;

            $book_categories = BookCategory::where('category_id', $category_id)->get();
            //dd($book_authors);
            $book_ids = [];
            foreach ($book_categories as $book_category) {

                $book_ids[] = $book_category->book_id;
            }

            $book_IDs = Book::whereIn('book_id', $book_ids)->get();

            $book_ids2 = [];
            foreach ($book_IDs as $book_ID) {

                $book_ids2[] = $book_ID->book_id;
            }

            $book_IDs2 = Book::whereIn('publication_id', $publisher_list)->whereIn('book_id', $book_ids2)->get();
            //dd($book_IDs2);
            $bookID = [];
            foreach ($book_IDs2 as $book_IDs) {

                $bookID[] = $book_IDs->book_id;
            }

            //dd($bookID);
            if ($bookID != null) {

                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $bookID)->where('is_visible', 1)->get();

                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {
                $bookID = [];
                $author_name = "";
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        } elseif ($price != null) {
            $category_id = $request->category_id;

            $book_categories = BookCategory::where('category_id', $category_id)->get();
            //dd($book_authors);
            $book_list = [];
            foreach ($book_categories as $book_category) {

                $book_list[] = $book_category->book_id;
            }

            if ($price == 100) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereBetween('discounted_price', [0, 100])->where('is_visible', 1)->get();

                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } elseif ($price == 500) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereBetween('discounted_price', [100, 500])->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } elseif ($price == 1000) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereBetween('discounted_price', [500, 1000])->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } elseif ($price == 1500) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->whereBetween('discounted_price', [1000, 2000])->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } elseif ($price == 2000) {
                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->where('discounted_price', '=>', 2000)->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {

                $book_categories = BookCategory::where('category_id', $category_id)->get();

                $book_ids = [];
                foreach ($book_categories as $book_category) {

                    $book_ids[] = $book_category->book_id;
                }

                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $book_list)->where('is_visible', 1)->get();
                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            }

            $author_name = "";
            if ($bookID != null) {

                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $bookID)->where('is_visible', 1)->get();


                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {
                $bookID = [];
                $author_name = "";
            }

            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name' => $author_name,
            ]);
        } else {
            $category_id = $request->category_id;
            $category_books = BookCategory::where('category_id', $category_id)->get();
            //dd($category_books);

            $bookID = [];
            foreach ($category_books as $category_book) {

                $bookID[] = $category_book->book_id;
            }

            //dd($book_ids)

            $author_name = "";
            if ($bookID != null) {

                // $bookID=Book::with('authors')->whereIn('book_id',$bookID)->get();

                $bookID = Book::with('authors', 'reviews')->whereIn('book_id', $bookID)->where('is_visible', 1)->get();

                foreach ($bookID as $book) {
                    $rating = getTotalRating($book->reviews);
                    $book->rating = $rating;
                }
            } else {
                $bookID = [];
                $author_name = "";
            }

            //$bookID=Book::all();
            return response()->json([
                'success' => true,
                'book_list' => $bookID,

            ]);
        }
    }
}
