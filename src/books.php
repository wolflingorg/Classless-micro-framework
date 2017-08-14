<?php
namespace app\src\books;

use app\core;
use app\exceptions\HttpNotFoundException;

/**
 * Books page
 * Shows all books or search results + pagination
 *
 * @return null|string
 */
function index() {
    $criteria = [
        'q' => isset($_GET['q']) ? htmlspecialchars((string)$_GET['q']) : '',
        'sort' => 'date',
        'length' => 2,
        'offset' => isset($_GET['page']) ? ceil((int)$_GET['page'] * 2) : 0
    ];

    return core\renderView(['default_layout.php', 'books/index.php'], [
        'content' => core\renderFile('books.php', 'app\\src\\books\\filterByCriteria', [$criteria]),
    ]);
}

/**
 * Returns book by id
 *
 * @param $id
 *
 * @return null|string
 * @throws HttpNotFoundException
 */
function bookById($id) {
    global $app;

    $book = array_filter($app['books'], function ($book) use ($id) {
        return $book['id'] == $id;
    });

    if (empty($book)) {
        throw new HttpNotFoundException();
    }

    return core\renderView(['default_layout.php', 'books/book_by_id.php'], [
        'book' => current($book)
    ]);
}

/**
 * Filters books
 *
 * @param array $criteria
 *
 * @return null|string
 */
function filterByCriteria($criteria = []) {
    global $app;

    $criteria = array_merge([
        'q' => null,
        'tag' => null,
        'sort' => null,
        'length' => 3,
        'offset' => 0,
        'total' => 0
    ], $criteria);

    $books = $app['books'];

    if (!empty($criteria['q'])) {
        $q = $criteria['q'];

        $books = array_filter($books, function ($book) use ($q) {
            return preg_match('/' . $q . '/i', $book['name']);
        });
    }
    if (!empty($criteria['tag'])) {
        $tag = $criteria['tag'];

        $books = array_filter($books, function ($book) use ($tag) {
            return !empty($book['tags']) && in_array($tag, (array)$book['tags']);
        });
    }
    if (!empty($criteria['sort'])) {
        $key = trim($criteria['sort'], '-');
        $direction = substr($criteria['sort'], 0, 1) == '-' ? 1 : -1;

        usort($books, function ($a, $b) use ($key, $direction) {
            if (!array_key_exists($key, $a) || !array_key_exists($key, $b)) {
                return 0;
            }

            return $a[$key] == $b[$key] ? 0 : ($a[$key] > $b[$key] ? 1 * $direction : -1 * $direction);
        });
    }

    $criteria['total'] = sizeof($books);

    return core\renderView(['books/books_list.php'], [
        'books' => array_slice($books, $criteria['offset'], $criteria['length']),
        'criteria' => $criteria
    ]);
}

$app['books'] = [
    [
        'id' => 1,
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51mk+9J-dbL._AC_US218_.jpg',
        'name' => 'Learning php, mysql & JavaScript',
        'author' => 'Robin Nixon',
        'price' => 30,
        'date' => '2017-08-12',
        'tags' => ['php', 'javascript', 'mysql'],
        'link' => 'https://www.amazon.com/Learning-PHP-MySQL-JavaScript-Javascript/dp/1491918667/',
        'info' => <<<HTML
<div><b>The fully revised, updated and extended 4th edition of the hugely popular web development book - includes CSS, HTML5, jQuery and the mysqli extension.</b><br><br>
Build interactive, data-driven websites with the potent combination of open-source technologies and web standards, even if you only have basic HTML knowledge. With this popular hands-on guide, you'll tackle dynamic web programming with the help of today's core technologies: PHP, MySQL, JavaScript, jQuery, CSS, and HTML5.<br>Explore each technology separately, learn how to use them together, and pick up valuable web programming practices along the way. At the end of the book, you'll put everything together to build a fully functional social networking site, using XAMPP or any development stack of your choice.<br><ul><li>Learn PHP in-depth, along with the basics of object-oriented programming</li><li>Explore MySQL, from database structure to complex queries</li><li>Use the mysqli Extension, PHP's improved MySQL interface</li><li>Create dynamic PHP web pages that tailor themselves to the user</li><li>Manage cookies and sessions, and maintain a high level of security</li><li>Master the JavaScript language--and enhance it with jQuery</li><li>Use Ajax calls for background browser/server communication</li><li>Acquire CSS2 &amp; CSS3 skills for professionally styling your web pages</li><li>Implement all the new HTML5 features, including geolocation, audio, video, and the canvas</li></ul></div>
HTML
    ],
    [
        'id' => 2,
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/41Bgqdnu7kL._AC_US218_.jpg',
        'name' => 'Php for the Web: Visual QuickStart Guide',
        'author' => 'Larry Ullman',
        'price' => 25,
        'date' => '2017-08-11',
        'tags' => ['php'],
        'link' => 'https://www.amazon.com/PHP-Web-Visual-QuickStart-Guide/dp/0134291255/',
        'info' => <<<HTML
<div>With <b>PHP for the Web: Visual QuickStart Guide</b>&nbsp;readers can start from the beginning to get a tour of the programming language, or look up specific tasks to learn just what they need to know.&nbsp;<div> <br> </div> <div>This task-based visual reference guide uses step-by-step instructions and plenty of screenshots to teach beginning and intermediate users this popular open-source scripting language. Author Larry Ullman guides readers through the ins and outs of both PHP 5 and PHP 7, and offers more efficient ways to tackle common needs. <br> <br>Both beginning users, who want a thorough introduction to the technology, and more intermediate users, who are looking for a convenient reference, will find what they need here--in straightforward language and through readily accessible examples.</div> <div> <p style="margin:0px;"> </p> <ul> <li>Easy visual approach uses demonstrations and real-world examples to&nbsp;guide you through dynamic web development using PHP and show you&nbsp;what to do step by step.</li> <li>Concise steps and explanations let you get up and running in no time.</li> <li>Essential reference guide keeps you coming back again and again.</li> <li>Whether you’re a programming newbie or an experienced veteran&nbsp;learning PHP for the first time, this book will teach you all you need to&nbsp;know, including the latest changes in PHP and more efficient ways&nbsp;to tackle common needs.</li> </ul> <p style="margin:0px;"> </p> </div> <div> <br> </div> <div> <br> </div> <div> <br> </div></div>      
HTML
    ],
    [
        'id' => 3,
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/41kKdIyD06L._AC_US218_.jpg',
        'name' => 'pHp and MySqL for Dynamic Web Sites',
        'author' => 'Larry Ullman',
        'price' => 14.39,
        'date' => '2017-08-05',
        'tags' => ['php', 'mysql'],
        'link' => 'https://www.amazon.com/PHP-MySQL-Dynamic-Web-Sites/dp/0134301846/',
        'info' => <<<HTML
<div><p style="MARGIN: 0px">When it comes to creating dynamic, database-driven Web sites, the PHP language and MySQL database offer a winning combination -- and with PHP 7, web professionals can achieve dramatic performance improvements. Combine these great open source technologies with Larry Ullman's <b>PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide, Fifth Edition</b>, and there's no limit to the powerful, interactive Web sites you can create. </p>  <p style="MARGIN: 0px">&nbsp;</p>  <p style="MARGIN: 0px">With step-by-step instructions, complete scripts, and expert tips to guide you, Ullman gets right down to business. After grounding you with practical introductions to both PHP 7 and MySQL, he covers core issues ranging from security to session management to jQuery and object-oriented programming techniques. Ullman walks you through creating several sample applications, stressing the latest features and techniques throughout.</p></div>
HTML
    ],
    [
        'id' => 4,
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/516kv5hpwuL._AC_US218_.jpg',
        'name' => 'Modern PhP: New Features and Good Practices',
        'author' => 'Josh Lockhart',
        'price' => 24,
        'date' => '2017-08-10',
        'tags' => ['php'],
        'link' => 'https://www.amazon.com/Modern-PHP-Features-Good-Practices/dp/1491905018/',
        'info' => <<<HTML
<div><p>PHP is experiencing a renaissance, though it may be difficult to tell with all of the outdated PHP tutorials online. With this practical guide, you’ll learn how PHP has become a full-featured, mature language with object-orientation, namespaces, and a growing collection of reusable component libraries.</p><p>Author Josh Lockhart—creator of PHP The Right Way, a popular initiative to encourage PHP best practices—reveals these new language features in action. You’ll learn best practices for application architecture and planning, databases, security, testing, debugging, and deployment. If you have a basic understanding of PHP and want to bolster your skills, this is your book.</p><ul><li>Learn modern PHP features, such as namespaces, traits, generators, and closures</li><li>Discover how to find, use, and create PHP components</li><li>Follow best practices for application security, working with databases, errors and exceptions, and more</li><li>Learn tools and techniques for deploying, tuning, testing, and profiling your PHP applications</li><li>Explore Facebook’s HVVM and Hack language implementations—and how they affect modern PHP</li><li>Build a local development environment that closely matches your production server</li></ul></div>
HTML
    ],
    [
        'id' => 5,
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/41oa41LdNdL._AC_US218_.jpg',
        'name' => 'JavaScript and JQuery: Interactive Front-End Web Development',
        'author' => 'Jon Duckett',
        'price' => 20,
        'date' => '2017-08-09',
        'tags' => ['javascript', 'jquery'],
        'link' => 'https://www.amazon.com/JavaScript-JQuery-Interactive-Front-End-Development/dp/1118531647/',
        'info' => <<<HTML
<div>This full-color book will show you how to make your websites more interactive and your interfaces more interesting and intuitive.<br><br> <b>THIS BOOK COVERS:</b><br> <ol> <li><b>Basic programming concepts</b> - assuming <i>no prior knowledge</i> of programming beyond an ability to create a web page using HTML &amp; CSS</li> <li><b>Core elements of the JavaScript language</b> - so you can learn how to write your own scripts from scratch</li> <li><b>jQuery</b> - which will allow you to simplify the process of writing scripts (this is introduced half-way through the book once you have a solid understanding of JavaScript)</li> <li><b>How to recreate techniques you will have seen on other web sites</b> such as sliders, content filters, form validation, updating content using Ajax, and much more (these examples demonstrate writing your own scripts from scratch and how the theory you have learned is put into practice).</li> </ol> As with our first book (the best-selling <b>HTML &amp; CSS: Design and Build Websites</b>), each chapter:<br> <ul> <li>Breaks subjects down into bite-sized chunks with a new topic on each page</li> <li>Contains clear descriptions of syntax, each one demonstrated with inspiring code samples</li> <li>Uses diagrams and photography to explain complex concepts in a visual way</li> </ul> By the end of the book, not only will you be able to use the thousands of scripts, JavaScript APIs, and jQuery plugins that are freely available on the web, and be able to customize them - you will also be able to create your own scripts from scratch.<br><br> If you're looking to create more enriching web experiences, then this is the book for you.</div>
HTML
    ],
    [
        'id' => 6,
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51A741xAWAL._AC_US218_.jpg',
        'name' => 'Miss Peregrine\'s Home for Peculiar Children',
        'author' => 'Ransom Riggs',
        'date' => '2017-08-08',
        'price' => 8.18,
        'link' => 'https://www.amazon.com/Miss-Peregrines-Home-Peculiar-Children/dp/1594746036/',
        'info' => <<<HTML
<div><b>The #1&nbsp;<i>New York Times</i>&nbsp;Best Seller is now a major motion picture from visionary director Tim Burton, starring Eva Green, Asa Butterfield, Ella&nbsp;Purnell, Samuel L. Jackson, and Judi Dench.&nbsp;</b><br> <b>&nbsp;</b><br> <b>Includes an excerpt from <i>Hollow City</i> and an interview with author Ransom Riggs</b><br> <i>&nbsp;</i><br> A mysterious island.  <br> &nbsp;<br> An abandoned orphanage.  <br> &nbsp;<br> A strange collection of very curious photographs.  <br> &nbsp;<br> It all waits to be discovered in <i>Miss Peregrine’s Home for Peculiar Children</i>, an unforgettable novel that mixes fiction and photography in a thrilling reading experience. As our story opens, a horrific family tragedy sets sixteen-year-old Jacob journeying to a remote island off the coast of Wales, where he discovers the crumbling ruins of Miss Peregrine’s Home for Peculiar Children. As Jacob explores its abandoned bedrooms and hallways, it becomes clear that the children were more than just peculiar. They may have been dangerous. They may have been quarantined on a deserted island for good reason. And somehow—impossible though it seems—they may still be alive.   A spine-tingling fantasy illustrated with haunting vintage photography, <i>Miss Peregrine’s Home for Peculiar Children</i> will delight adults, teens, and anyone who relishes an adventure in the shadows.<br> &nbsp;<br> <b>“A tense, moving, and wondrously strange first novel. The photographs and text work together brilliantly to create an unforgettable story.”—John Green, <i>New York Times</i> best-selling author of <i>The Fault in Our Stars</i></b><br> <b><i>&nbsp;</i></b><br> <b>“With its <i>X-Men: First Class</i>-meets-time-travel story line, David Lynchian imagery, and rich, eerie detail, it’s no wonder <i>Miss Peregrine’s Home for Peculiar Children </i>has been snapped up by Twentieth Century Fox. B+”—<i>Entertainment Weekly</i></b><br> <b><i>&nbsp;</i></b><br> <b>“‘Peculiar’ doesn’t even begin to cover it. Riggs’ chilling, wondrous novel is already headed to the movies.”—<i>People</i></b><br> <b><i>&nbsp;</i></b><br> <b>“You’ll love it if you want a good thriller for the summer. It’s a mystery, and you’ll race to solve it before Jacob figures it out for himself.”—<i>Seventeen</i></b></div>
HTML
    ]
];
