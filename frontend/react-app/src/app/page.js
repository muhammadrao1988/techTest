'use client'
import {useState, useEffect} from 'react';
import process from "next/dist/build/webpack/loaders/resolve-url-loader/lib/postcss";


export default function Home() {
    const [articles, setArticles] = useState();
    const [paginationLinks, setPaginationLinks] = useState();
    const [currentPage, setCurrentPage] = useState(1);
    const [selectedArticle, setSelectedArticle] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);

    useEffect(() => {
        fetchArticles(currentPage);
    }, [currentPage]);

    const fetchArticles = async (page) => {
        try {
            const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}articles?page=${page}`);
            const data = await res.json();
            setArticles(data.data); // Adjust according to your API response structure
            setPaginationLinks(data.links); // Adjust according to your API response structure
            setCurrentPage(page);
        } catch (error) {
            console.error('Error fetching articles:', error);
        }
    };

    const handlePageChange = (pageUrl) => {
        if (pageUrl) {
            const pageNumber = new URL(pageUrl).searchParams.get('page');
            if (pageNumber) {
                setCurrentPage(Number(pageNumber));
            }
        }
    };
    const handleOpenModal = (article) => {
        setSelectedArticle(article);
        setIsModalOpen(true);
    };

    const handleCloseModal = () => {
        setIsModalOpen(false);
        setSelectedArticle(null);
    };
    return (
        <main className="container flex min-h-screen flex-col items-center justify-between mx-auto p-4 mt-5 mb-20">
            <div className="z-10  w-full items-center justify-between font-mono text-sm lg:flex">
                <div
                    className="fixed bottom-0 left-0 flex h-48 w-full items-end  bg-gradient-to-t from-white via-white dark:from-black dark:via-black lg:static lg:h-auto lg:w-auto lg:bg-none">
                    <h1>
                        Tech Test weConnect
                    </h1>
                </div>
            </div>

            <h1 className="text-3xl font-bold mb-4 mt-10">Articles</h1>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                {articles?.map((article) => (
                    <div
                        key={article.id}
                        className="border p-4 rounded-lg shadow-lg cursor-pointer"
                        onClick={() => handleOpenModal(article)}
                    >
                        {article.image && (
                            <img
                                src={process.env.NEXT_PUBLIC_S3_URL +article.image}
                                alt={article.title}
                                className="w-full h-40 object-cover mb-4"
                            />
                        )}
                        <h2 className="text-xl font-semibold mb-2">{article.title}</h2>
                        <p>{article.content.substring(0, 100)}...</p>
                    </div>
                ))}
            </div>
            <div className="flex justify-center items-center mt-4 space-x-2">

                {paginationLinks?.map((link, index) => (
                    <button
                        key={index}
                        onClick={() => handlePageChange(link.url)}
                        disabled={link.active}
                        className={`px-4 py-2 rounded ${link.active ? 'bg-black text-white' : 'bg-gray-300 text-black'}`}
                    >
                        { link.label }
                    </button>
                ))}
                {isModalOpen && selectedArticle && (
                    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div className="fixed bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                            <button
                                onClick={handleCloseModal}
                                className="absolute top-4 right-4 text-gray-600 hover:text-gray-900"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    className="w-6 h-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    strokeWidth="2"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                >
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <h2 className="text-2xl font-semibold mb-4">{selectedArticle.title}</h2>
                            {selectedArticle.image && (
                                <img
                                    src={process.env.NEXT_PUBLIC_S3_URL +selectedArticle.image}
                                    alt={selectedArticle.title}
                                    className="w-full h-60 object-cover mb-4"
                                />
                            )}
                            <p>{selectedArticle.content}</p>
                        </div>
                    </div>
                )}
            </div>
        </main>
    );
}
