import "../css/app.css";
import React, { useState } from "react";
import ReactDOM from "react-dom/client";
import * as DropdownMenu from '@radix-ui/react-dropdown-menu';
import * as Dialog from '@radix-ui/react-dialog';

const sidebarItems = [
  { id: "dashboard", label: "Dashboard", icon: "📊" },
  { id: "users", label: "Users", icon: "👥" },
  { id: "posts", label: "Posts", icon: "📝" },
];

function AdminDashboard({ users = [], posts: postsProp = [] }) {
  const [activeTab, setActiveTab] = useState("users");
  const [selectedUser, setSelectedUser] = useState(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [selectedPost, setSelectedPost] = useState(null);
  const [isPostViewOpen, setIsPostViewOpen] = useState(false);
  const [isPostEditOpen, setIsPostEditOpen] = useState(false);
  const [posts, setPosts] = useState(postsProp);

  const handleLogout = () => {
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "/logout";

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (csrfToken) {
      const input = document.createElement("input");
      input.type = "hidden";
      input.name = "_token";
      input.value = csrfToken;
      form.appendChild(input);
    }

    document.body.appendChild(form);
    form.submit();
  };

  const handleViewUser = (user) => {
    setSelectedUser(user);
    setIsModalOpen(true);
  };

  const handleEditPostModal = (post) => {
  setSelectedPost(post);
  setIsPostEditOpen(true);
};

  const handleEditUser = (user) => console.log("Edit user:", user);
  const handleDeleteUser = (user) => {
    if (confirm(`Are you sure you want to delete user "${user.name}"?`)) {
      console.log("Delete user:", user);
    }
  };

  const handleEditPost = (post) => console.log("Edit post:", post);

  const handleDeletePost = async (post) => {
  if (!confirm(`Are you sure you want to delete post "${post.title}"?`)) return;

  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const res = await fetch(`/posts/${post.id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      }
    });

    if (res.ok) {
      setPosts((prevPosts) => prevPosts.filter(p => p.id !== post.id));
      alert("Post deleted successfully!");
    } else {
      alert("Failed to delete post.");
    }
  } catch (err) {
    console.error(err);
    alert("An error occurred.");
  }
};

  const handleViewPost = (post) => {
    setSelectedPost(post);
    setIsPostViewOpen(true);
  };

  const handleClosePostView = () => {
    setIsPostViewOpen(false);
    setSelectedPost(null);
  };

  const handleSavePost = (e) => {
    e.preventDefault();
    console.log("Updated post:", selectedPost);
    // TODO: send PUT/PATCH request to Laravel API
    setIsPostEditOpen(false);
  };


  function AdminPostView({ post, onBack }) {
  return (
    <div className="w-[900px] mx-auto bg-white rounded-xl border-5 border-deepBerry p-8 shadow-lg">
      {/* Header */}
      <div className="flex justify-between items-center mb-6">
        <h2 className="font-playfair text-3xl text-deepBerry font-bold">
          {post.title}
        </h2>
        <div className="text-sm text-gray-600 mt-1">
          By <span className="font-semibold">{post.user?.name || "Unknown"}</span> •{" "}
          {post.created_at ? new Date(post.created_at).toLocaleDateString("en-US", { month: "short", day: "2-digit", year: "numeric" }) : "No date"}
        </div>
      </div>

      {/* Post content */}
      <div className="prose max-w-none text-gray-800 leading-relaxed whitespace-pre-wrap">
        {post.content || "No content available."}
      </div>

      {/* Back button */}
      <div className="mt-8 flex justify-end">
        <button
          onClick={onBack}
          className="px-4 py-2 bg-gray-300 text-gray-800 rounded-full hover:bg-gray-400 transition"
        >
          ← Back
        </button>
      </div>
    </div>
  );
}

  return (
    <div className="flex h-screen bg-pink-50">
      {/* Sidebar */}
      <aside className="w-64 bg-deepBerry text-white flex flex-col shadow-lg">
        <div className="p-6">
          <h1 className="text-3xl font-bold font-Figtree">Admin Panel</h1>
          <p className="text-white-500 text-sm mt-2">Dashboard Management</p>
        </div>
        <nav className="flex-1 px-2">
          {sidebarItems.map((item) => (
            <button
              key={item.id}
              onClick={() => setActiveTab(item.id)}
              className={`flex items-center w-full text-left px-4 py-3 mb-1 rounded-lg transition-all duration-200 ${
                activeTab === item.id
                  ? "bg-white bg-opacity-20 text-white shadow-md"
                  : "text-white hover:bg-white hover:bg-opacity-10"
              }`}
            >
              <span className="mr-3 text-lg">{item.icon}</span>
              {item.label}
            </button>
          ))}
        </nav>

          <div className="p-4 border-t">
          <button
            onClick={handleLogout}
            className="w-full bg-deepBerry font-bold text-white py-2 rounded-lg hover:bg-mauvePink transition">
            Logout
          </button>
        </div> 

        <div className="p-4 border-t flex justify-center border-pink-300">
          <p className="text-pink-200 text-xs">Version 1.0</p>
        </div>
      </aside>

      {/* Main content */}
      <main className="flex-1 bg-pink-50 overflow-auto">
        <div className="max-w-7xl mx-auto p-8">
          <div className="bg-white rounded-xl border-2 border-deepBerry p-8 shadow-lg">
            {/* Header */}
            <div className="flex justify-between items-center mb-6">
              <h2 className="font-Figtree text-3xl text-deepBerry font-bold">
                {activeTab === "dashboard" && "Dashboard Overview"}
                {activeTab === "users" && "User Management"}
                {activeTab === "posts" && "Post Management"}
              </h2>
              <div className="text-right">
                <p className="text-gray-600 text-sm">Welcome back, Admin</p>
                <p className="text-black font-semibold">{new Date().toLocaleDateString()}</p>
              </div>
            </div>

            {/* Dashboard Overview */}
            {activeTab === "dashboard" && (
              <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="bg-gradient-to-br from-pink-100 to-pink-200 p-6 rounded-lg border border-pink-300">
                  <div className="flex items-center justify-between">
                    <div>
                      <h3 className="text-lg font-semibold text-[#8B2635]">Total Users</h3>
                      <p className="text-3xl font-bold text-[#8B2635]">{users.length}</p>
                    </div>
                    <div className="text-4xl">👥</div>
                  </div>
                </div>
                <div className="bg-gradient-to-br from-purple-100 to-purple-200 p-6 rounded-lg border border-purple-300">
                  <div className="flex items-center justify-between">
                    <div>
                      <h3 className="text-lg font-semibold text-[#8B2635]">Total Posts</h3>
                      <p className="text-3xl font-bold text-[#8B2635]">{posts.length}</p>
                    </div>
                    <div className="text-4xl">📝</div>
                  </div>
                </div>
                <div className="bg-gradient-to-br from-rose-100 to-rose-200 p-6 rounded-lg border border-rose-300">
                  <div className="flex items-center justify-between">
                    <div>
                      <h3 className="text-lg font-semibold text-[#8B2635]">Active Today</h3>
                      <p className="text-3xl font-bold text-[#8B2635]">{Math.floor(users.length * 0.3)}</p>
                    </div>
                    <div className="text-4xl">⚡</div>
                  </div>
                </div>
              </div>
            )}

            {/* Users Management */}
            {activeTab === "users" && (
              <div>
                {users.length > 0 ? (
                  <div className="overflow-x-auto">
                    <table className="w-full border-collapse">
                      <thead>
                        <tr className="bg-deepBerry text-white">
                          <th className="border border-gray-400 p-4 text-left">Name</th>
                          <th className="border border-gray-400 p-4 text-left">Email</th>
                          <th className="border border-gray-400 p-4 text-left">Role</th>
                          <th className="border border-gray-400 p-4 text-left">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        {users.map((user, index) => (
                          <tr key={index} className="hover:bg-pink-50 transition">
                            <td className="border border-gray-300 p-4 font-medium">
                              <div className="flex items-center">
                                <div className="w-8 h-8 bg-deepBerry text-white rounded-full flex items-center justify-center mr-3 text-sm">
                                  {user.name?.charAt(0)?.toUpperCase() || "U"}
                                </div>
                                {user.name}
                              </div>
                            </td>
                            <td className="border border-gray-300 p-4 text-gray-600">{user.email}</td>
                            <td className="border border-gray-300 p-4">
                              <span
                                className={`px-3 py-1 rounded-full flex justify-center text-xs font-semibold ${
                                  user.role === "admin"
                                    ? "bg-red-100 text-red-800"
                                    : user.role === "moderator"
                                    ? "bg-yellow-100 text-yellow-800"
                                    : "bg-green-100 text-green-800"
                                }`}
                              >
                                {user.role || "user"}
                              </span>
                            </td>
                             <td className="border border-gray-300 p-4">
                              <div className="flex gap-2 items-center">
                                <button
                                  onClick={() => handleViewUser(user)}
                                  className="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition text-sm"
                                >
                                  View
                                </button>

                                {/* Radix Dropdown Menu */}
                                <DropdownMenu.Root>
                                  <DropdownMenu.Trigger className="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">
                                    ⋮
                                  </DropdownMenu.Trigger>

                                  <DropdownMenu.Content
                                    className="bg-white rounded-md shadow-lg border p-1 min-w-[120px]"
                                    sideOffset={5}
                                 >
                                    <DropdownMenu.Item
                                      onSelect={() => handleEditUser(user)}
                                      className="px-3 py-2 text-sm hover:bg-gray-100 rounded-md cursor-pointer"
                                    >
                                      Edit
                                    </DropdownMenu.Item>
                                    <DropdownMenu.Item
                                      onSelect={() => handleDeleteUser(user)}
                                      className="px-3 py-2 text-sm hover:bg-gray-100 rounded-md cursor-pointer text-red-500"
                                    >
                                      Delete
                                    </DropdownMenu.Item>
                                  </DropdownMenu.Content>
                                </DropdownMenu.Root>
                              </div>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                ) : (
                  <div className="text-center py-12">
                    <div className="text-6xl mb-4">👥</div>
                    <p className="text-gray-600 italic text-lg">No users found.</p>
                    <p className="text-gray-500 text-sm mt-2">
                      Users will appear here once they register.
                    </p>
                  </div>
                )}
              </div>
            )}

            {/* Posts Management */}
            {activeTab === "posts" && (
              <div>
                {posts.length > 0 ? (
                  <div className="space-y-4">
                    {posts.map((post, index) => (
                      <div
                        key={index}
                        className="bg-white border border-gray-300 rounded-lg p-6 shadow-sm hover:shadow-md transition"
                      >
                        <div className="flex justify-between items-start">
                          <div className="flex-1">
                            <h3 className="text-xl font-bold text-deepBerry mb-2">
                              {post.title}
                            </h3>
                            <p className="text-gray-600 mb-3">
                              {post.content
                                ? post.content.substring(0, 120) + "..."
                                : "No content"}
                            </p>
                            <div className="flex items-center text-sm text-gray-500">
                              <span className="mr-4">
                                By:{" "}
                                <span className="font-medium">
                                  {post.user?.name || "Unknown Author"}
                                </span>
                              </span>
                              <span>
                                Date:{" "}
                                {post.created_at
                                  ? new Date(post.created_at).toLocaleDateString()
                                  : "No date"}
                              </span>
                            </div>
                          </div>
                          <div className="ml-4">
                            <DropdownMenu.Root>
                              <DropdownMenu.Trigger className="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">
                                ⋮
                              </DropdownMenu.Trigger>

                              <DropdownMenu.Content
                                className="bg-white rounded-md shadow-lg border p-1 min-w-[120px]"
                                sideOffset={5}
                              >
                                <DropdownMenu.Item
                                  onSelect={() => handleViewPost(post)}
                                  className="px-3 py-2 text-sm hover:bg-gray-100 rounded-md cursor-pointer"
                                >
                                  View
                                </DropdownMenu.Item>
                                <DropdownMenu.Item
                                  onSelect={() => handleEditPostModal(post)}
                                  className="px-3 py-2 text-sm hover:bg-gray-100 rounded-md cursor-pointer"
                                >
                                  Edit
                                </DropdownMenu.Item>
                                <DropdownMenu.Item
                                  onSelect={() => handleDeletePost(post)}
                                  className="px-3 py-2 text-sm hover:bg-gray-100 rounded-md cursor-pointer text-red-500"
                                >
                                  Delete
                                </DropdownMenu.Item>
                              </DropdownMenu.Content>
                            </DropdownMenu.Root>
                          </div>
                        </div>
                      </div>
                    ))}
                  </div>
                ) : (
                  <div className="text-center py-12">
                    <div className="text-6xl mb-4">📝</div>
                    <p className="text-gray-600 italic text-lg">No posts found.</p>
                    <p className="text-gray-500 text-sm mt-2">
                      Blog posts will appear here once created.
                    </p>
                  </div>
                )}
              </div>
            )}
          </div>
        </div>
      </main>

      {/* Radix Dialog for User Details */}
      <Dialog.Root open={isModalOpen} onOpenChange={setIsModalOpen}>
        <Dialog.Portal>
          <Dialog.Overlay className="fixed inset-0 bg-black bg-opacity-50" />
          <Dialog.Content className="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
            <Dialog.Title className="text-xl font-bold mb-4 text-deepBerry">
              User Details
            </Dialog.Title>
            {selectedUser && (
              <div className="space-y-3">
                <div className="flex items-center mb-4">
                  <div className="w-16 h-16 bg-deepBerry text-white rounded-full flex items-center justify-center text-2xl mr-4">
                    {selectedUser.name?.charAt(0)?.toUpperCase() || "U"}
                  </div>
                  <div>
                    <h4 className="text-xl font-semibold">{selectedUser.name}</h4>
                    <p className="text-gray-600 flex">{selectedUser.email}</p>
                  </div>
                </div>
                <div className="grid grid-cols-2 gap-4 justify-items-center">
                  <div>
                    <label className="block text-sm font-medium text-gray-700">
                      Role
                    </label>
                    <span
                      className={`inline-block px-3 py-1 rounded-full text-xs font-semibold ${
                        selectedUser.role === "admin"
                          ? "bg-red-100 text-red-800"
                          : selectedUser.role === "moderator"
                          ? "bg-yellow-100 text-yellow-800"
                          : "bg-green-100 text-green-800"
                      }`}
                    >
                      {selectedUser.role || "user"}
                    </span>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700">
                      Status
                    </label>
                    <span className="text-green-600 font-medium">Active</span>
                  </div>
                </div>
                {selectedUser.created_at && (
                  <div className="justify-items-center">
                    <label className="block text-sm font-medium text-gray-700">
                      Member Since
                    </label>
                    <p className="text-gray-900">
                      {new Date(selectedUser.created_at).toLocaleDateString()}
                    </p>
                  </div>
                )}
              </div>
            )}
        <div className="mt-4 flex justify-end">
          <Dialog.Close asChild>
            <button className="px-4 py-2 bg-deepBerry text-white rounded-full hover:bg-pink transition">
              Close
            </button>
          </Dialog.Close>
        </div>
          </Dialog.Content>
        </Dialog.Portal>
      </Dialog.Root>

      {/* Radix Dialog for Post Details (example) */}
      <Dialog.Root open={isPostViewOpen} onOpenChange={setIsPostViewOpen}>
        <Dialog.Portal>
          <Dialog.Overlay className="fixed inset-0 bg-black bg-opacity-50" />
          <Dialog.Content className="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[950px] mx-4 bg-white rounded-lg p-6 shadow-xl">
            {selectedPost && (
              <AdminPostView post={selectedPost} onBack={() => setIsPostViewOpen(false)} />
            )}
          </Dialog.Content>
        </Dialog.Portal>
      </Dialog.Root>

      <Dialog.Root open={isPostEditOpen} onOpenChange={setIsPostEditOpen}>
        <Dialog.Portal>
          <Dialog.Overlay className="fixed inset-0 bg-black bg-opacity-50" />
          <Dialog.Content className="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[900px] mx-4 bg-white rounded-xl border-2 border-deepBerry p-8 shadow-lg">
            <Dialog.Title className="text-2xl font-bold mb-4 text-deepBerry">
              Edit Post
            </Dialog.Title>
              {selectedPost && (
                <form className="space-y-4" onSubmit={(e) => handleSavePost(e)}>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                      Title
                    </label>
                    <input
                      type="text"
                      className="w-full border rounded px-3 py-2"
                      value={selectedPost.title}
                      onChange={(e) => setSelectedPost({ ...selectedPost, title: e.target.value })}
                    />
                  </div>
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">
              Content
            </label>
            <textarea
              className="w-full border rounded px-3 py-2 h-40"
              value={selectedPost.content}
              onChange={(e) => setSelectedPost({ ...selectedPost, content: e.target.value })}
            />
          </div>

          <div className="flex justify-end gap-2 mt-4">
            <button
              type="submit"
              className="px-4 py-2 bg-deepBerry text-white rounded-full hover:bg-pink transition"
            >
              Save Changes
            </button>
            <Dialog.Close asChild>
            <button className="px-4 py-2 bg-gray-300 text-gray-800 rounded-full hover:bg-gray-400 transition">
              Cancel
            </button>
            </Dialog.Close>
          </div>
        </form>
      )}
    </Dialog.Content>
  </Dialog.Portal>
</Dialog.Root>      

      </div>
    );
  }

// Initialize component
const el = document.getElementById("admin-dashboard");
if (el) {
  const users = JSON.parse(el.dataset.users || "[]");
  const posts = JSON.parse(el.dataset.posts || "[]");

  ReactDOM.createRoot(el).render(
    <AdminDashboard users={users} posts={posts} />
  );
}
